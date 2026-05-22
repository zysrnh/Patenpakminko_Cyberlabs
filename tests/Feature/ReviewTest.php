<?php
 
namespace Tests\Feature;
 
use App\Models\User;
use App\Models\Review;
use App\Models\LapolpaBooking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
 
class ReviewTest extends TestCase
{
    use RefreshDatabase;
 
    protected $pelakuUsaha;
    protected $adminDpn;
    protected $booking;
 
    protected function setUp(): void
    {
        parent::setUp();
 
        // 1. Buat Pelaku Usaha
        $this->pelakuUsaha = User::factory()->create([
            'role' => 'pelaku_usaha',
            'username' => 'budi_pu',
        ]);
 
        // 2. Buat Admin DPN
        $this->adminDpn = User::factory()->create([
            'role' => 'dpn',
            'username' => 'admin_dpn',
        ]);
 
        // 3. Buat Booking LAPOLPA selesai
        $this->booking = LapolpaBooking::create([
            'user_id' => $this->pelakuUsaha->id,
            'whatsapp_number' => '081234567890',
            'booking_date' => '2026-05-22',
            'time_start' => '10:00:00',
            'time_end' => '11:00:00',
            'status' => 'selesai',
        ]);
    }
 
    /**
     * Test tamu (guest) tidak boleh mengirim ulasan.
     */
    public function test_guest_cannot_submit_review()
    {
        $response = $this->post('/review', [
            'module_type' => 'lapolpa',
            'module_id' => $this->booking->id,
            'rating' => 5,
            'comment' => 'Komentar ulasan dari tamu',
        ]);
 
        $response->assertRedirect('/login');
        $this->assertDatabaseEmpty('reviews');
    }
 
    /**
     * Test Pelaku Usaha dapat mengirim ulasan & status defaultnya is_approved = false.
     */
    public function test_pelaku_usaha_can_submit_review_moderated_by_default()
    {
        $response = $this->actingAs($this->pelakuUsaha)
            ->post('/review', [
                'module_type' => 'lapolpa',
                'module_id' => $this->booking->id,
                'rating' => 5,
                'comment' => 'Pelayanan LAPOLPA sangat memuaskan!',
            ]);
 
        $response->assertRedirect();
        $response->assertSessionHas('success');
 
        $this->assertDatabaseHas('reviews', [
            'user_id' => $this->pelakuUsaha->id,
            'module_type' => 'lapolpa',
            'module_id' => $this->booking->id,
            'rating' => 5,
            'rating_label' => 'Sangat Baik',
            'comment' => 'Pelayanan LAPOLPA sangat memuaskan!',
            'is_approved' => false, // Harus False secara default (moderasi)
        ]);
    }
 
    /**
     * Test Anti-Spam: Pelaku Usaha tidak bisa mengirim ulasan ganda untuk permohonan yang sama.
     */
    public function test_anti_spam_prevents_multiple_reviews()
    {
        // Ulasan Pertama
        Review::create([
            'user_id' => $this->pelakuUsaha->id,
            'module_type' => 'lapolpa',
            'module_id' => $this->booking->id,
            'rating' => 5,
            'rating_label' => 'Sangat Baik',
            'comment' => 'Ulasan pertama',
            'is_approved' => false,
        ]);
 
        // Kirim Ulasan Kedua (Ganda)
        $response = $this->actingAs($this->pelakuUsaha)
            ->post('/review', [
                'module_type' => 'lapolpa',
                'module_id' => $this->booking->id,
                'rating' => 4,
                'comment' => 'Ulasan kedua yang spamming',
            ]);
 
        $response->assertSessionHasErrors(['review_spam']);
        $this->assertDatabaseCount('reviews', 1); // Tetap hanya 1 ulasan di database
    }
 
    /**
     * Test Admin DPN dapat menyetujui (approve) ulasan.
     */
    public function test_admin_can_approve_review()
    {
        $review = Review::create([
            'user_id' => $this->pelakuUsaha->id,
            'module_type' => 'lapolpa',
            'module_id' => $this->booking->id,
            'rating' => 5,
            'rating_label' => 'Sangat Baik',
            'comment' => 'Pelayanan bagus sekali!',
            'is_approved' => false,
        ]);
 
        $response = $this->actingAs($this->adminDpn)
            ->post("/admin/reviews/{$review->id}/approve");
 
        $response->assertRedirect(route('admin.reviews.index'));
        $this->assertTrue($review->fresh()->is_approved);
    }
 
    /**
     * Test ulasan yang belum disetujui TIDAK tampil di landing page,
     * tetapi ulasan yang sudah disetujui AKAN tampil di landing page.
     */
    public function test_approved_reviews_are_displayed_on_welcome_page()
    {
        // 1. Buat ulasan belum disetujui
        $unapprovedReview = Review::create([
            'user_id' => $this->pelakuUsaha->id,
            'module_type' => 'lapolpa',
            'module_id' => $this->booking->id,
            'rating' => 3,
            'rating_label' => 'Cukup Baik',
            'comment' => 'Ulasan belum disetujui',
            'is_approved' => false,
        ]);
 
        // 2. Buat ulasan sudah disetujui
        $approvedReview = Review::create([
            'user_id' => $this->pelakuUsaha->id,
            'module_type' => 'lapolpa',
            'module_id' => $this->booking->id,
            'rating' => 5,
            'rating_label' => 'Sangat Baik',
            'comment' => 'Ulasan sudah disetujui dan nampak',
            'is_approved' => true,
        ]);
 
        // Buka landing page
        $response = $this->get('/');
 
        $response->assertStatus(200);
        $response->assertSee('Ulasan sudah disetujui dan nampak');
        $response->assertDontSee('Ulasan belum disetujui');
    }
}

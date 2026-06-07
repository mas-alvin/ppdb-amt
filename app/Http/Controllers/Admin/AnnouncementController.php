<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Services\AnnouncementService;
use App\Http\Requests\Admin\StoreAnnouncementRequest;
use Illuminate\Http\Request;
use Exception;

class AnnouncementController extends Controller
{
    protected $announcementService;

    public function __construct(AnnouncementService $announcementService)
    {
        $this->announcementService = $announcementService;
    }

    public function index()
    {
        $announcements = Announcement::latest()->get();
        return view('pages.admin.content.index', compact('announcements'));
    }

    public function store(StoreAnnouncementRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = auth()->id();
            
            $this->announcementService->storeAnnouncement($data);

            return back()->with('success', 'Pengumuman berhasil diterbitkan.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function update(StoreAnnouncementRequest $request, Announcement $content)
    {
        try {
            $this->announcementService->updateAnnouncement($content, $request->validated());
            return back()->with('success', 'Pengumuman berhasil diperbarui.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Announcement $content)
    {
        try {
            $this->announcementService->deleteAnnouncement($content);
            return back()->with('success', 'Pengumuman berhasil dihapus.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function toggleStatus(Announcement $content)
    {
        $this->announcementService->toggleStatus($content);
        return back()->with('success', 'Status pengumuman berhasil diubah.');
    }
}

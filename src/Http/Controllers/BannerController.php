<?php

namespace AvoRed\Banner\Http\Controllers;

use AvoRed\Banner\Database\Contracts\BannerInterface;
use AvoRed\Banner\Database\Models\Banner;
use AvoRed\Banner\Http\Requests\BannerImageRequest;
use AvoRed\Banner\Http\Requests\BannerRequest;
use AvoRed\Framework\Support\Facades\Tab;

class BannerController
{
    /**
     * Banner Repository for the Install Command.
     * @var \AvoRed\Banner\Database\Repository\CategoryRepository
     */
    protected $bannerRepository;

    /**
     * Construct for the AvoRed install command.
     * @param \AvoRed\Framework\Database\Contracts\CategoryModelInterface $bannerRepository
     */
    public function __construct(
        BannerInterface $bannerRepository
    ) {
        $this->bannerRepository = $bannerRepository;
    }


    public function index()
    {
        $banners = $this->bannerRepository->paginate();
        return view('avored-banner::banner.index')
            ->with('banners', $banners);
    }

    public function create()
    {
        $tabs = Tab::get('cms.banner');
        $targetOptions = collect(['_self' => 'Same Tab', '_blank' => 'New Tab']);
        return view('avored-banner::banner.create')
            ->with('tabs', $tabs)
            ->with('targetOptions', $targetOptions);
    }
    public function store(BannerRequest $request)
    {
        $this->bannerRepository->create($request->all());

        return redirect()->route('admin.banner.index');
    }
    public function edit(Banner $banner)
    {
        $tabs = Tab::get('cms.banner');
        $targetOptions = collect(['_self' => 'Same Tab', '_blank' => 'New Tab']);
        return view('avored-banner::banner.edit')
            ->with('banner', $banner)
            ->with('tabs', $tabs)
            ->with('targetOptions', $targetOptions);
    }

    /**
     * Remove the specified resource from storage.
     * @param Banner  $banner
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();

        return response()->json([
            'success' => true,
            'message' => __(
                'avored::system.notification.delete',
                ['attribute' => __('avored-banner::banner.title')]
            ),
        ]);
    }
    public function update(Banner $banner, BannerRequest $request)
    {
        $banner->update($request->all());

        return redirect()->route('admin.banner.index');
    }

    /**
     * upload banner image to file system.
     * @param \AvoRed\Framework\System\Requests\AdminUserImageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(BannerImageRequest $request)
    {
        $image = $request->file('files');
        $path = $image->store('uploads/banners', 'avored');

        return response()->json([
            'success' => true,
            'path' => $path,
            'message' => __('avored::user.notification.upload', ['attribute' => __('avored-banner::banner.title')]),
        ]);
    }

    public function adminJS()
    {
        $file = __DIR__ . '/../../../dist/js/banner.js';

        $expires = strtotime('+1 year');
        $lastModified = filemtime($file);
        $cacheControl = 'public, max-age=31536000';

        return response()->file($file, [
            'Content-Type' => 'application/javascript; charset=utf-8',
            'Expires' => sprintf('%s GMT', gmdate('D, d M Y H:i:s', $expires)),
            'Cache-Control' => $cacheControl,
            'Last-Modified' => sprintf('%s GMT', gmdate('D, d M Y H:i:s', $lastModified)),
        ]);
    }
    public function frontJS()
    {
        $file = __DIR__ . '/../../../dist/js/carousel.js';

        $expires = strtotime('+1 year');
        $lastModified = filemtime($file);
        $cacheControl = 'public, max-age=31536000';

        return response()->file($file, [
            'Content-Type' => 'application/javascript; charset=utf-8',
            'Expires' => sprintf('%s GMT', gmdate('D, d M Y H:i:s', $expires)),
            'Cache-Control' => $cacheControl,
            'Last-Modified' => sprintf('%s GMT', gmdate('D, d M Y H:i:s', $lastModified)),
        ]);
    }
}

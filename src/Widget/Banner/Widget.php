<?php

namespace AvoRed\Banner\Widget\Banner;

use AvoRed\Banner\Database\Contracts\BannerInterface;
use AvoRed\Framework\Support\Contracts\WidgetInterface;
use AvoRed\Banner\Models\Database\Banner;

class Widget implements WidgetInterface
{
    /**
     * Widget View Path
     * @var string $view
     */

    protected $view = "avored-banner::widget.index";

    /**
     * Widget Label
     * @var string $view
     */

    protected $label;

    /**
     * Widget Type
     * @var string $view
     */

    protected $type = "cms";

    /**
     * Widget unique identifier
     * @var string $identifier
     */
    protected $identifier = "avored-banner";

    public function view()
    {
        return $this->view;
    }

    /*
     * Widget unique identifier
     *
     */
    public function identifier()
    {
        return $this->identifier;
    }

    /*
    * Widget unique identifier
    *
    */
    public function label()
    {
        return __('avored-banner::banner.banner_slider');
    }

    /*
    * Widget unique identifier
    *
    */
    public function type()
    {
        return $this->type;
    }

    /**
     * View Required Parameters
     *
     * @return array
     */
    public function with()
    {
        $repository = app(BannerInterface::class);
        $banners = $repository->getAllEnabledBanner();
        return ['banners' => $banners];
    }

    public function render()
    {
        return view($this->view())
            ->with($this->with());
    }
}

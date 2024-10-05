<?php
/**
 * Description of PanelResource.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace App\Http\Resources;


use App\Models\Exoplanet;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin  Exoplanet
 */
class ExoplanetApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);
        $data['star'] = $this->star->toArray();
        $data['publications'] = $this->publications->all();
        return $data;
    }

}

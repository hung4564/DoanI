<?php

namespace App\Traits\Policies;

use Illuminate\Http\Request;

trait PolicyHelper
{
  /**
   * @return mixed
   */
  private function getResourceModel()
  {
      if (property_exists($this, 'resourceModel') && !empty($this->resourceModel)) {
          return $this->resourceModel;
      } else {
          throw new \InvalidArgumentException('The property "resourceModel" is not defined');
      }
  }
}

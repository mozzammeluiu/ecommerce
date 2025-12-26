<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
  public function category(): BelongsTo
  {
  	return $this->belongsTo(Category::class);
  }

  public function subcategory(): BelongsTo
  {
  	return $this->belongsTo(SubCategory::class);
  }

  public function subsubcategory(): BelongsTo
  {
  	return $this->belongsTo(SubSubCategory::class);
  }

  public function brand(): BelongsTo
  {
  	return $this->belongsTo(Brand::class);
  }

  public function user(): BelongsTo
  {
  	return $this->belongsTo(User::class);
  }

  public function orderDetails(){
    return $this->hasMany(OrderDetail::class);
  }

  public function reviews(){
    return $this->hasMany(Review::class)->where('status', 1);
  }

  public function wishlists(){
    return $this->hasMany(Wishlist::class);
  }
}

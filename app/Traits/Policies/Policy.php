<?php

namespace App\Traits\Policies;
use App\User;
use Illuminate\Http\Request;

trait Policy
{
  //admin có tất cả các quyền
  public function before(User $user, $ability)
  {
      if ($user->isAdmin()) {
          return true;
      }
  }
  /**
   * Kiếm tra ai có thể thấy danh sách
   *
   * @param  User $user
   * @return mixed
   */
  public function viewList(User $user)
  {
      return $user->isAdmin();
  }
  /**
   * Xác định xem người dùng có thể xem hay không.
   *
   * @param  \App\User  $user
   * @param   @model
   * @return mixed
   */
  public function view(User $user, $model)
  {
      return $user->isAdmin();
  }

  /**
   * Xác định xem người dùng có thể tạo mới hay không.
   *
   * @param  \App\User  $user
   * @return mixed
   */
  public function create(User $user)
  {
      return $user->isAdmin();
  }

  /**
   * Xác định xem người dùng có thể cập nhập hay không.
   *
   * @param  \App\User  $user
   * @param   $model
   * @return mixed
   */
  public function update(User $user, $model)
  {
      return $user->isAdmin();
  }

  /**
   * Xác định xem người dùng có thể xóa hay không.
   *
   * @param  \App\User  $user
   * @param   $model
   * @return mixed
   */
  public function delete(User $user, $model)
  {
      return $user->isAdmin();
  }
}

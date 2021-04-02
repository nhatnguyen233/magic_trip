<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class UserRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'firstname' => ['required'],
            'lastname' => ['required', 'unique:users'],
            'email' => ['required', 'unique:users', 'email', 'confirmed'],
            'password' => ['required', 'min:6'],
            'name' => ['required'],
            'card_number' => ['required'],
            'expire_month' => ['required'],
            'expire_year' => ['required'],
            'ccv' => ['required'],
            'country_id' => ['required'],
            'ward_id' => ['required'],
            'district_id' => ['required'],
            'province_id' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'firstname' => 'Mời bạn nhập tên',
            'lastname' => 'Mời bạn nhập họ',
            'email' => 'Mời bạn nhập email',
            'password' => 'Mời bạn nhập mật khẩu',
            'name' => 'Mời bạn nhập tên thẻ',
            'card_number' => 'Mời ban nhâp số thẻ',
            'expire_month' => 'Mời bạn nhập tháng',
            'expire_year' => 'Mời bạn nhâph năm',
            'ccv' => 'Mời bạn nhập mã bảo mât',
            'country_id' => 'Mời bạn nhập quốc gia',
            'province_id' => 'Mời bạn nhap tinh',
            'district' => 'Mời bạn nhập quan',
            'ward_id' => 'Mời bạn nhập xa phuong',
        ];
    }
}

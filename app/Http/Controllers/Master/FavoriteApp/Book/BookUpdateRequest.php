<?php

namespace App\Http\Controllers\Master\FavoriteApp\Book;

use App\Lib\Business\App\Master\FavoriteApp\Book\Models\AdminBookUpdateParam;
use App\Lib\Common\Type\DreamerTypeList;
use Illuminate\Foundation\Http\FormRequest;

class BookUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:255',

            // publisherList là request param bắt buộc
            // publisherList là request param kiểu mảng
            // publisherList là request param kiểu mảng có ít nhất một phần từ mảng
                // Nếu publisherList là một mảng rỗng hoặc không được cung cấp thì sẽ ứng với lỗi required
                // Nếu publisherList là một mảng có ít hơn số phần tử min được chỉ định sẽ ứng với lỗi min
            'publisherList' => 'required|array|min:1',

            // Trong mỗi phần tử của publisherList, thuộc tính publisherId là bắt buộc
            // publisherId phải mang giá trị số
            // min:0 => Giá trị tối thiểu là 0 và không cho phép giá trị âm
            // not_in => Giá trị không thể là 0
            'publisherList.*.publisherId' => 'required|numeric|min:0|not_in:0'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'            => 'Tiêu đề sách là bắt buộc',
            'title.max'                 => 'Tiêu đề sách không được dài quá 255 ký tự',

            'publisherList.*.publisherId.required'    => 'Danh sách NXB là bắt buộc',
            'publisherList.*.publisherId.not_in'      => 'Vui lòng chọn NXB'
        ];
    }

    public function getUpdateParam(): AdminBookUpdateParam
    {
        $updateParam = new AdminBookUpdateParam();

        $updateParam->setBookId($this->bookId);

        $updateParam->setTitle($this->title);
        $updateParam->setPublisherList(new DreamerTypeList($this->publisherList));

        $updateParam->setRemovePublisherList(new DreamerTypeList($this->removePublisherList));

        return $updateParam;
    }
}

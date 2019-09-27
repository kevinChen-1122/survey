<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;
use App\Imports\InquiryImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportInquiryPost extends Action
{
	public $name = '导入数据';
	
    protected $selector = '.import-inquiry-post';

    public function handle(Request $request)
    {
		try {
			// $request ...
			$file = $request->file('file');
			$file_path = $file->path();
			$data = Excel::import(new InquiryImport, $file_path);
			return $this->response()->success('导入完成！')->refresh();
		} catch (Exception $e) {
			return $this->response()->error('产生错误：'.$e->getMessage());
		}
    }

	public function form()
    {
        $this->file('file', '请选择文件');
    }
	
    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-default import-inquiry-post"><i class="fa fa-upload"></i>导入数据</a>
HTML;
    }
}
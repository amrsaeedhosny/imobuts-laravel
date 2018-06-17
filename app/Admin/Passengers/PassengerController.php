<?php

namespace App\Admin\Passengers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\ModelForm;

class PassengerController extends Controller
{
    //
	use ModelForm;

	/**
	 * Index interface.
	 *
	 * @return Content
	 */
	public function index()
	{
		return Admin::content(function (Content $content) {

			$content->header('header');
			$content->description('description');

			$content->body($this->grid());
		});
	}

	/**
	 * Edit interface.
	 *
	 * @param $id
	 * @return Content
	 */
	public function edit($id)
	{
		return Admin::content(function (Content $content) use ($id) {

			$content->header('header');
			$content->description('description');

			$content->body($this->form()->edit($id));
		});
	}

	/**
	 * Create interface.
	 *
	 * @return Content
	 */
	public function create()
	{
		return Admin::content(function (Content $content) {

			$content->header('header');
			$content->description('description');

			$content->body($this->form());
		});
	}

	/**
	 * Make a grid builder.
	 *
	 * @return Grid
	 */
	protected function grid()
	{
		return Admin::grid(Passenger::class, function (Grid $grid) {

			$grid->id('ID')->sortable();
			$grid->username('User Name');
			$grid->email('Email');
			$grid->balance('Balance');
			$grid->token('Token');
			$grid->created_at();
			$grid->updated_at();
		});
	}

	/**
	 * Make a form builder.
	 *
	 * @return Form
	 */
	protected function form()
	{
		return Admin::form(Passenger::class, function (Form $form) {

			$form->display('id', 'ID');

			$form->display('created_at', 'Created At');
			$form->display('updated_at', 'Updated At');
		});
	}
}

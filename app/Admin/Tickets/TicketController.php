<?php

namespace App\Admin\Tickets;

use App\Admin\Passengers\Passenger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\ModelForm;

class TicketController extends Controller
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
		return Admin::grid(Ticket::class, function (Grid $grid) {

			$grid->id('ID')->sortable();
			$grid->code('Code');
			$grid->price('Price');
			$grid->passenger('Passenger')->display(function ($passenger){
				return "<span class='label label-success'>{$passenger['username']}</span>";
			});
			$grid->date('Date');
		});
	}

	/**
	 * Make a form builder.
	 *
	 * @return Form
	 */
	protected function form()
	{
		return Admin::form(Ticket::class, function (Form $form) {

			$form->display('id', 'ID');
			$form->text('code','Code');
			$form->number('price','Price');
			$form->select( 'passengerID', 'Passenger' )->options( Passenger::pluck( 'username', 'id' )->all() );
			$form->datetime('date','Date');
			$form->display('created_at', 'Created At');
			$form->display('updated_at', 'Updated At');
		});
	}
}

<div class="modal-dialog" role="document">
  <div class="modal-content">

    {!! Form::open(['url' => action([\Modules\Accounting\Http\Controllers\AccountingAccountCostCenterController::class, 'store']), 
        'method' => 'post', 'id' => 'transfer_form' ]) !!}

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Add Cost Center</h4>
    </div>

    <div class="modal-body">
        <div class="form-group">
            {!! Form::label('name', 'Name' .":*") !!}
            {!! Form::text('name', '', ['class' => 'form-control', 
                'required','placeholder' => 'Name' ]); !!}
        </div>
    </div>
    
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
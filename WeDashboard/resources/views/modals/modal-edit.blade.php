<div class="modal fade" id="editEmployee" role="dialog" aria-labelledby="editEmployeeLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            {!! Form::open(array('action' => 'EmployeesController@update', 'method' => 'put', 'role' => 'form')) !!}
            {!! csrf_field() !!}
            <div class="modal-header">
              <h4 class="modal-title">
                {{ trans('modals.form_modal_default_title') }}
              </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <div class="row">
                  <div class="col">
                      <div class="form-group row has-feedback">
                          <div class="col-md-12">
                              <div class="input-group">
                                {!! Form::hidden('employee', null, array('id' => 'employee', 'required' => 'required')) !!}
                                {!! Form::label('job_title', trans('forms.business_label_job_title'), array('for' => 'job_title')); !!}
                                {!! Form::text('job_title', null, array('id' => 'job_title', 'required' => 'required', 'class' => 'form-control', 'placeholder' => trans('forms.business_ph_job_title'))) !!}     
                              </div>
                              @if($errors->has('job_title'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('job_title') }}</strong>
                              </span>
                             @endif
                          </div>
                      </div>
                      <div class="form-group row has-feedback">
                          <div class="col-md-12">
                              <div class="input-group">
                                {!! Form::label('responsability', trans('forms.business_label_responsability'), array('for' => 'responsability')); !!}
                                {!! Form::text('responsability', null, array('id' => 'responsability', 'required' => 'required', 'class' => 'form-control', 'placeholder' => trans('forms.business_ph_responsability'))) !!}
                              </div>
                              @if($errors->has('responsability'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('responsability') }}</strong>
                              </span>
                             @endif
                          </div>
                      </div>
                      @if ($business->project)
                      <div class="form-group has-feedback row">
                        <div class="col-md-12">
                            <input type="range" name="salary" id="salary-range" min="1">
                            <label for="salary">Salary <span id="salary-output"></span> <span id="salary-currency"></span> </label>
                        </div>
                    </div>
                    @endif
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              {!! Form::button('<i class="fa fa-fw fa-close" aria-hidden="true"></i> ' . trans('modals.form_modal_default_btn_cancel'), array('class' => 'btn btn-secondary', 'type' => 'button', 'data-dismiss' => 'modal' )) !!}
              {!! Form::button('<i class="fa fa-fw fa-check" aria-hidden="true"></i> ' . trans('modals.form_modal_default_btn_submit'), array('class' => 'btn btn-primary', 'type' => 'submit', 'id' => 'update' )) !!}
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
      
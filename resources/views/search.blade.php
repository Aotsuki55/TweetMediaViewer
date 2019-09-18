<div class="container" style="margin-top: 50px;">
<div class="col-md-1"></div>
<div class="col-md-10">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <button class="btn btn-info btn-block" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" role="button" aria-expanded="false" aria-controls="collapseTwo">
          検索表示
        </button>
      </h4>
    </div><!-- /.panel-heading -->
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        
      <form action="{{ url('/view/find')}}" method="GET" class="form-horizontal">
        {{ csrf_field() }}

        <div class="form-group row">
          <div class="col-xs-6">
            <div class="row">
                <label class="col-md-3 control-label" for="userName">User</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="userName" id="userName" placeholder="" value="{{isset($request['userName'])?$request['userName']:null}}">
              </div>
            </div>
          </div>
          <div class="col-xs-6">
            <div class="row">
                <label class="col-md-3 control-label" for="screenName">ScreenName</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="screenName" id="screenName" placeholder="" value="{{isset($request['screenName'])?$request['screenName']:null}}">
              </div>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-xs-6">
            <div class="row">
              <label class="col-md-3 control-label" for="fab">Fab</label>
              <div class="col-xs-9">
                <div class="row">
                  <!-- <div class="col-xs-6">
                    <div class="row">
                      <div class="col-md-9">
                        <input type="text" class="form-control text-center" name="userName" placeholder="max">
                      </div>
                        <label class="col-md-3 control-label" for="InputName">↑</label>
                    </div>
                  </div>
                  <div class="col-xs-6">
                    <div class="row">
                        <label class="col-md-3 control-label" for="InputName">↓</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control text-center" name="userName" placeholder="min">
                      </div>
                    </div>
                  </div> -->
                  <div class="col-md-5">
                    <input type="text" class="form-control text-center" name="fabMin" id="fab" placeholder="min" value="{{isset($request['fabMin'])?$request['fabMin']:null}}">
                  </div>
                  <label class="col-md-2 control-label" for="InputName">〜</label>
                  <div class="col-md-5">
                    <input type="text" class="form-control text-center" name="fabMax" id="fab" placeholder="max" value="{{isset($request['fabMax'])?$request['fabMax']:null}}">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xs-6">
            <div class="row">
              <label class="col-md-3 control-label" for="rt">Rt</label>
              <div class="col-xs-9">
                <div class="row">
                  <div class="col-md-5">
                    <input type="text" class="form-control text-center" name="rtMin" id="rt" placeholder="min" value="{{isset($request['rtMin'])?$request['rtMin']:null}}">
                  </div>
                  <label class="col-md-2 control-label" for="InputName">〜</label>
                  <div class="col-md-5">
                    <input type="text" class="form-control text-center" name="rtMax" id="rt" placeholder="max" value="{{isset($request['rtMax'])?$request['rtMax']:null}}">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="form-group row">
          <div class="col-xs-6">
            <div class="row">
              <label class="col-md-3 control-label" for="savedAt">Saved_at</label>
              <div class="col-xs-9">
                <div class="row">
                  <div class="col-md-5">
                    <input type="text" class="form-control text-center datetimepicker" name="savedAtSince" id="savedAt" placeholder="min" value="{{isset($request['savedAtSince'])?$request['savedAtSince']:null}}">
                  </div>
                  <label class="col-md-2 control-label" for="InputName">〜</label>
                  <div class="col-md-5">
                    <input type="text" class="form-control text-center datetimepicker" name="savedAtMax" id="savedAt" placeholder="max" value="{{isset($request['savedAtMax'])?$request['savedAtMax']:null}}">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xs-6">
            <div class="row">
              <label class="col-md-3 control-label" for="updatedAt">Updated_at</label>
              <div class="col-xs-9">
                <div class="row">
                  <div class="col-md-5">
                    <input type="text" class="form-control text-center datetimepicker" name="updatedAtSince" id="updatedAt" placeholder="min" value="{{isset($request['updatedAtSince'])?$request['updatedAtSince']:null}}">
                  </div>
                  <label class="col-md-2 control-label" for="InputName">〜</label>
                  <div class="col-md-5">
                    <input type="text" class="form-control text-center datetimepicker" name="updatedAtMax" id="updatedAt" placeholder="max" value="{{isset($request['updatedAtMax'])?$request['updatedAtMax']:null}}">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-xs-6">
            <div class="row">
                <label class="col-md-3 control-label" for="status">Status</label>
              <div class="col-md-9">
                <select class="form-control" name="status" id="status">
                  <option></option>
                  <option value="0">0(watched)</option>
                  <option value="1">1(trashbox)</option>
                  <option value="2">2(fav)</option>
                  <option value="3">3(best)</option>
                  <option value="-1">-1(deleted)</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-xs-6">
            <div class="row">
                <label class="col-md-3 control-label" for="type">Type</label>
              <div class="col-md-9">
                <select class="form-control" name="type" id="type">
                  <option></option>
                  <option value="photo">photo</option>
                  <option value="animated_gif">gif</option>
                  <option value="video">video</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-xs-offset-1 col-xs-2">
            <button type="reset" id="reset" class="btn btn-default btn-block">Reset</button>
          </div>
          <div class="col-xs-2">
            <button type="reset" id="trash" class="btn btn-warning btn-block">Trash</button>
          </div>
          <div class="col-xs-6">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
          </div>
        </div>

        </form>

      </div><!-- /.panel-body -->
    </div><!-- /.panel-collapse -->
  </div><!-- /.panel -->
  </div>
  <div class="col-md-1"></div>
</div>
<div class="container" style="margin-bottom: 50px;">
  <div class="col-xs-1"></div>
    <div class="col-xs-10">
      <div class="col-xs-3">
        <button class="btn btn-default btn-block" id="selectAll">Select All</button>
      </div>
      <div class="col-xs-6">
        <button class="btn btn-primary btn-block" id="delete">Delete</button>
      </div>
      <div class="col-xs-3">
        <button class="btn btn-primary btn-block" id="allDelete">All Delete</button>
      </div>
    </div>
  <div class="col-xs-1"></div>
</div>
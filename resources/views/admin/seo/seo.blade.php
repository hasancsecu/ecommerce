@extends('admin.admin_layouts')

@section('admin_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>SEO Settings</h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">SEO Settings </h6> <br>

            <form action="{{route('update.seo')}}" method="post">
                @csrf
                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Meta Title: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="meta_title" value="{{$seo->meta_title}}">
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Meta Author: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="meta_author"
                                    value="{{$seo->meta_author}}">
                            </div>
                        </div><!-- col-6 -->
                        <div class=" col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Meta Tag: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="meta_tag" value="{{$seo->meta_tag}}">
                            </div>
                        </div><!-- col-6 -->

                        <div class=" col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Meta Description: <span
                                        class="tx-danger">*</span></label>
                                <textarea class="form-control" name="meta_description" id="summernote">
                                            {!! $seo->meta_description !!}
                                    </textarea>
                            </div>
                        </div><!-- col-12 -->

                        <div class=" col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Google Analytics: <span
                                        class="tx-danger">*</span></label>
                                <textarea class="form-control" name="meta_description" id="summernote1">
                                    {!! $seo->google_analytics !!}
                                    </textarea>
                            </div>
                        </div><!-- col-12 -->
                        <div class=" col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Bing Analytics: <span
                                        class="tx-danger">*</span></label>
                                <textarea class="form-control" name="meta_description" id="summernote2">
                                    {!! $seo->bing_analytics !!}
                                    </textarea>
                            </div>
                        </div><!-- col-12 -->
                        <input type="hidden" name="id" value="{{$seo->id}}">

                    </div><!-- row -->

                    <div class="form-layout-footer">
                        <button class="btn btn-info mg-r-5" style="cursor:pointer" type="submit">Update</button>
                    </div><!-- form-layout-footer -->
                </div><!-- form-layout -->
        </div><!-- card -->
        </form>
    </div>
</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->

@endsection
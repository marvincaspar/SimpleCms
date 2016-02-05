@extends('simple-cms::layouts.admin')

@section('content-header')
    <h1>
        {{ trans('simple-cms::contact.title') }}
        <small>{{ trans('simple-cms::contact.title_small') }}</small>
    </h1>
@stop

@section('content-body')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('manage.contacts.update', array('id' => $contact->id)) }}"
                  id="site-form" class="form-horizontal" method="POST">
                {!! method_field('PUT') !!}
                {!! csrf_field() !!}

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('simple-cms::contact.box_title') }}</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                @foreach($contact->getFillable() as $attribute)
                                    <div class="form-group {{ $errors->has($attribute) ? 'has-error' : '' }}">
                                        <label for="{{ $attribute }}"
                                               class="col-sm-2 control-label">{{ trans('simple-cms::contact.attributes.' . $attribute ) }}</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="{{ $attribute }}"
                                                   id="{{ $attribute }}"
                                                   placeholder="{{ trans('simple-cms::contact.attributes.' . $attribute) }}"
                                                   value="{{ old($attribute, $contact->$attribute) }}">

                                            @if ($errors->has($attribute))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first($attribute) }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary" type="submit">
                                    {{ trans('simple-cms::generic.save') }}
                                </button>
                                <a class="btn btn-default"
                                   href="{{ route('manage.contacts.edit', array('id' => $contact->id)) }}">
                                    {{ trans('simple-cms::generic.cancel') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

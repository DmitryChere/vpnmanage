<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>VPN Manage</title>
        <link rel="stylesheet" href="/css/styles.css">
        <link rel="stylesheet" href="/css/font-awesome.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    </head>
    <body>
        <div class="container main-tabs-control clearfix">
            <div data-id="companies" class="active">
                {{ trans('main.companiesLabel') }}
            </div>
            <div data-id="users">
                {{ trans('main.usersLabel') }}
            </div>
            <div data-id="abusers">
                {{ trans('main.abusersLabel') }}
            </div>
        </div>

        {{--MESSAGE BLOCK--}}
        @if (session('message'))
            <div class="alert">
                @if (is_array(session('message')))
                    @foreach(session('message') as $msg)
                        {{ $msg }}<br>
                    @endforeach
                @else
                    {{ session('message') }}
                @endif
            </div>
        @endif

        <div id="companies" class="container main-tab">
            <div class="title">{{ trans('main.companiesLabel') }}</div>

            {{--ITEMS TABLE--}}
            <div class="items-list">
                <table>
                    <thead>
                    <tr>
                        <td>
                            {{ trans('main.nameLabel') }}
                        </td>
                        <td>
                            {{ trans('main.quotaLabel') }}
                        </td>
                        <td>
                            {{--ACTIONS--}}
                            {{ trans('main.actionsLabel') }}
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                        {{--LIST--}}
                        @foreach($companies as $company)
                            @include('rows.company', ['company' => $company])
                        @endforeach

                        <tr class="new none">
                            <td data-cname="{{ trans('main.nameLabel') }}">
                                <input name="name" value="">
                            </td>
                            <td data-cname="{{ trans('main.quotaLabel') }}">
                                <input name="quota" value="">
                            </td>
                            <td data-cname="{{ trans('main.actionsLabel') }}">
                                <span data-action="/company/add" class="action-item edit active">
                                    <i class="fa fa-check"></i>
                                    <span>{{ trans('main.saveLabel') }}</span>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <span class="action-item add">
                    <i class="fa fa-plus-circle"></i>
                    <span>{{ trans('main.addLabel') }}</span>
                </span>
            </div>
        </div>
        <div id="users" class="container main-tab none">
            <div class="title">{{ trans('main.usersLabel') }}</div>

            {{--ITEMS TABLE--}}
            <div class="items-list">
                <table>
                    <thead>
                    <tr>
                        <td>
                            {{ trans('main.nameLabel') }}
                        </td>
                        <td>
                            {{ trans('main.emailLabel') }}
                        </td>
                        <td>
                            {{ trans('main.companyLabel') }}
                        </td>
                        <td>
                            {{--ACTIONS--}}
                            {{ trans('main.actionsLabel') }}
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                        {{--LIST--}}
                        @foreach($users as $user)
                            @include('rows.user', ['user' => $user, 'companies' => $companies])
                        @endforeach

                        <tr class="new none" data-action="/user/add">
                            <td data-cname="{{ trans('main.nameLabel') }}">
                                <input name="name" value="">
                            </td>
                            <td data-cname="{{ trans('main.emailLabel') }}">
                                <input name="email" value="">
                            </td>
                            <td data-cname="{{ trans('main.companyLabel') }}">
                                <select name="company_id">
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}">
                                            {{ $company->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td data-cname="{{ trans('main.actionsLabel') }}">
                                <span data-action="/user/add" class="action-item edit active">
                                    <i class="fa fa-check"></i>
                                    <span>{{ trans('main.saveLabel') }}</span>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <span class="action-item add">
                    <i class="fa fa-plus-circle"></i>
                    <span>{{ trans('main.addLabel') }}</span>
                </span>
            </div>
        </div>
        <div id="abusers" class="container main-tab none">
            <div class="title">{{ trans('main.abusersLabel') }}</div>

            <div class="report-manage">
                <span class="action-item generate pointer">
                    <i class="fa fa-random"></i> {{ trans('main.generateLabel') }}
                </span>

                <select name="month">
                    @foreach($months as $month)
                        <option value="{{ $month['value'] }}">{{ $month['label'] }}</option>
                    @endforeach
                </select>

                <span class="action-item report pointer">
                    <i class="fa fa-bars"></i> {{ trans('main.reportLabel') }}
                </span>
            </div>

            {{--ITEMS TABLE--}}
            <div class="report-content items-list none">
                <table>
                    <thead>
                    <tr>
                        <td>
                            {{ trans('main.companyLabel') }}
                        </td>
                        <td>
                            {{ trans('main.usedLabel') }}
                        </td>
                        <td>
                            {{ trans('main.quotaLabel') }}
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                        {{--LIST--}}
                    </tbody>
                </table>
        </div>

        <script src="/js/jquery.js"></script>
        <script src="/js/jquery.validate.min.js"></script>
        <script src="/js/main.js"></script>
    </body>
</html>
<tr data-id="{{ $company->id }}">
    <td data-cname="{{ trans('main.nameLabel') }}">
        <input name="name" value="{{ $company->name }}">
        <span class="value">{{ $company->name }}</span>
    </td>
    <td data-cname="{{ trans('main.quotaLabel') }}">
        <input name="quota" value="{{ $company->quota }}">
        <span class="value">{{ bytesFormat($company->quota, 2) }}</span>
    </td>
    <td data-cname="{{ trans('main.actionsLabel') }}">
        <span data-action="/company/edit/{{ $company->id }}" class="action-item edit">
            <i class="fa fa-pencil"></i>
            <span>{{ trans('main.editLabel') }}</span>
        </span>
        <span data-action="/company/remove/{{ $company->id }}" class="action-item del">
            <i class="fa fa-trash"></i>
            <span>{{ trans('main.removeLabel') }}</span>
        </span>
    </td>
</tr>
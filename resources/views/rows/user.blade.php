<tr data-id="{{ $user->id }}">
    <td data-cname="{{ trans('main.nameLabel') }}">
        <input name="name" value="{{ $user->name }}">
        <span class="value">{{ $user->name }}</span>
    </td>
    <td data-cname="{{ trans('main.emailLabel') }}">
        <input name="email" value="{{ $user->email }}">
        <span class="value">{{ $user->email }}</span>
    </td>
    <td data-cname="{{ trans('main.companyLabel') }}">
        <select name="company_id">
            @foreach($companies as $company)
                <option value="{{ $company->id }}" {{ $user->company && $user->company->id == $company->id ? 'selected' : '' }}>
                    {{ $company->name }}
                </option>
            @endforeach
        </select>
        <span class="value">
            {{ $user->company ? $user->company->name : trans('main.noCompanyLabel') }}
        </span>
    </td>
    <td data-cname="{{ trans('main.actionsLabel') }}">
        <span class="action-item edit" data-action="/user/edit/{{ $user->id }}">
            <i class="fa fa-pencil"></i>
            <span>{{ trans('main.editLabel') }}</span>
        </span>
        <span class="action-item del" data-action="/user/remove/{{ $user->id }}">
            <i class="fa fa-trash"></i>
            <span>{{ trans('main.removeLabel') }}</span>
        </span>
    </td>
</tr>
@foreach($data as $item)
<tr>
    <td data-cname="{{ trans('main.companyLabel') }}">
        <span class="value">{{ $item->name }}</span>
    </td>
    <td data-cname="{{ trans('main.usedLabel') }}">
        <span class="value">{{ bytesFormat($item->used_quota, 2) }}</span>
    </td>
    <td data-cname="{{ trans('main.quotaLabel') }}">
        <span class="value">{{ bytesFormat($item->quota, 2) }}</span>
    </td>
</tr>
@endforeach
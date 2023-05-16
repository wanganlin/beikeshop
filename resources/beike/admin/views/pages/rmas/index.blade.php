@extends('Admin::layouts.master')

@section('title', __('Admin/rma.index'))

@section('content')
  <div id="customer-app" class="card h-min-600">
    <div class="card-body">
      <div class="mb-2">{{ __('Admin/rma.rma_list_title') }}</div>
      @if (count($rmas))
        <div class="table-push">
          <table class="table">
            <thead>
              <tr>
                <th>{{ __('Admin/rma.customers_name') }}</th>
                <th>{{ __('common.email') }}</th>
                <th>{{ __('common.phone') }}</th>
                <th>{{ __('Admin/builder.modules_product') }}</th>
                <th>{{ __('product.sku') }}</th>
                <th>{{ __('Admin/rma.quantity') }}</th>
                <th>{{ __('Admin/rma.service_type') }}</th>
                <th>{{ __('common.status') }}</th>
                <th>{{ __('common.action') }}</th>
              </tr>
            </thead>
            <tbody>
              @if (count($rmas_format))
                @foreach ($rmas_format as $rma)
                  <tr>
                    <td>{{ $rma['name'] }}</td>
                    <td>{{ $rma['email'] }}</td>
                    <td>{{ $rma['telephone'] }}</td>
                    <td>{{ $rma['product_name'] }}</td>
                    <td>{{ $rma['sku'] }}</td>
                    <td>{{ $rma['quantity'] }}</td>
                    <td>{{ $rma['type'] }}</td>
                    <td>{{ $rma['status'] }}</td>
                    <td><a href="{{ admin_route('rmas.show', [$rma['id']]) }}"
                        class="btn btn-outline-secondary btn-sm">{{ __('common.view') }}</a>
                    </td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="9" class="border-0">
                    <x-admin-no-data />
                  </td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
        {{ $rmas->links('Admin::vendor/pagination/bootstrap-4') }}
      @else
        <x-admin-no-data />
      @endif
    </div>
  </div>
@endsection

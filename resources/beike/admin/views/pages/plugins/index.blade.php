@extends('Admin::layouts.master')

@section('title', __('Admin/plugin.plugin_list'))

@section('Page-title-right')
  @hookwrapper('admin.plugin.marketing')
  <a href="{{ admin_route('marketing.index', isset($type) ? ['type' => $type]: '') }}" class="btn btn-outline-info">{{ __('common.get_more') }}</a>
  @endhookwrapper
@endsection

@section('content')

  <div id="plugins-app" class="card" v-cloak>
    <div class="card-body h-min-600">
      <div class="mt-4 table-push" style="">
        <table class="table" v-if="plugins.length">
          <thead>
            <tr>
              <th>{{ __('Admin/plugin.plugin_code') }}</th>
              <th>{{ __('Admin/plugin.plugin_type') }}</th>
              <th width="50%">{{ __('Admin/plugin.plugin_description') }}</th>
              <th>{{ __('Admin/common.status') }}</th>
              <th>{{ __('Admin/common.action') }}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="plugin, index in plugins" :key="index">
              <td>@{{ plugin.code }}</td>
              <td>@{{ plugin.type_format }}</td>
              <td>
                <div class="plugin-describe d-flex align-items-center">
                  <div class="me-2" style="flex: 0 0 50px;"><img :src="plugin.icon" class="img-fluid border"></div>
                  <div>
                    <h6>@{{ plugin.name }}</h6>
                    <div class="" v-html="plugin.description"></div>
                  </div>
                </div>
              </td>
              <td>
                <el-switch :disabled="!plugin.installed" v-model="plugin.status" @change="(e) => {pluginStatusChange(e, plugin.code, index)}"></el-switch>
              </td>
              <td>
                <div v-if="plugin.installed">
                  <span :style="!plugin.status ? 'cursor: not-allowed':''">
                    <a v-if="plugin.type != 'theme'" :class="['btn btn-outline-secondary btn-sm', !plugin.status ? 'disabled' : '' ]" :href="plugin.edit_url">{{ __('Admin/common.edit') }}</a>
                    <a v-else :class="['btn btn-outline-secondary btn-sm', !plugin.status ? 'disabled' : '' ]" href="{{ admin_route('theme.index') }}">{{ __('Admin/plugin.to_enable') }}</a>
                  </span>
                  <a class="btn btn-outline-danger btn-sm" @click="installedPlugin(plugin.code, 'uninstall', index)">{{ __('Admin/common.uninstall') }}</a>
                </div>
                <div v-else>
                  <a class="btn btn-outline-success btn-sm" @click="installedPlugin(plugin.code, 'install', index)">{{ __('Admin/common.install') }}</a>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <div v-else>
          <x-admin-no-data>
            <x-slot:text>
              {{ __('common.no_data') }} <a href="{{ admin_route('marketing.index', isset($type) ? ['type' => $type]: '') }}" ><i class="bi bi-link-45deg"></i> {{ __('common.get_more') }}</a>
            </x-slot>
          </x-admin-no-data>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('footer')
  <script>
    new Vue({
      el: '#plugins-app',

      data: {
        plugins: @json($plugins ?? []),
      },

      beforeMount() {

      },

      methods: {
        pluginStatusChange(e, code, index) {
          const self = this;

          $http.put(`plugins/${code}/status`, {status: e * 1}).then((res) => {
            layer.msg(res.message)
          }).catch((res) => {
            this.plugins[index].status = !this.plugins[index].status;
          });
        },

        installedPlugin(code, type, index) {
          if (type == 'uninstall') {
            layer.confirm('{{ __('Admin/plugin.uninstall_hint') }}', {
              title: "{{ __('common.text_hint') }}",
              btn: ['{{ __('common.cancel') }}', '{{ __('common.confirm') }}'],
              area: ['400px'],
              btn2: () => {
                this.installedPluginXhr(code, type, index);
              }
            })
            return;
          }

          this.installedPluginXhr(code, type, index);
        },

        installedPluginXhr(code, type, index) {
          $http.post(`plugins/${code}/${type}`).then((res) => {
            layer.msg(res.message)
            this.plugins[index].installed = type == 'install' ? true : false;
          })
        }
      }
    })
  </script>
@endpush

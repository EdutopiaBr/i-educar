@extends('layout.default')

@section('content')

    <div id="app-content">

        <access-level-menu :menus="menus" :level="1" :text="''"></access-level-menu>

    </div>

@endsection

@push('script')
    <div id="access-level-menu" class="vue-template">
        <div class="access-level-menu">
            <template v-for="menu in menus" :key="menu.id">
                <ul>
                    <li>
                        <div style="padding-bottom: 10px">
                            <div style="font-size: 16px">@{{ menu.title }}</div>
                            <div>@{{ text + menu.title }}</div>
                        </div>
                        <access-level-menu :text="text + menu.title + ' > '" :menus="menu.children" :level="level + 1"></access-level-menu>
                    </li>
                </ul>
            </template>
        </div>
    </div>

    <style>
        .access-level-menu ul {
            list-style: none;
            padding: 0;
        }
        .access-level-menu .level-1 {
            padding-left: 5px;
        }
        .access-level-menu .level-2 {
            padding-left: 10px;
        }
        .access-level-menu .level-3 {
            padding-left: 15px;
        }
        .access-level-menu .level-4 {
            padding-left: 20px;
        }
        .access-level-menu .level-5 {
            padding-left: 25px;
        }
        .alm-container {
            display: flex;
        }
        .alm-item {
            flex: 1;
        }
    </style>

    <script>
        Vue.component('access-level-menu', {
            props: ['menus', 'level', 'text'],
            template: '#access-level-menu'
        });

        new Vue({
            el: '#app-content',
            data: {
                menus: @json($menus)
            }
        });
    </script>
@endpush

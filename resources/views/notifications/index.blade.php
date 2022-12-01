<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="relative rounded-xl overflow-auto p-8">
                        <div class="row notification-list">
                            <div class="col-md-3">
                                <a href="{{route('notifications.create')}}" class="notification-item notification-create">
                                    <span class="notification-title">Створити сповіщення</span>
                                    <img class="notification-item-create-icon" src="{{asset('images/Feather-core-plus-circle.svg')}}" alt="create">
                                </a>
                            </div>
                            @foreach($notifications as $notification)
                            <div class="col-md-3">
                                <div class="notification-item">
                                    <div class="notification-item-head">
                                        <a href="javascript:void(0)" data-id="{{$notification->id}}" class="notification-delete"><i class="fa fa-close"></i></a>
                                    </div>
                                    <span class="notification-title">{{$notification->name}}</span>
                                    <div class="notification-item-bottom">
                                        <div class="notification-item-remote">
                                            <a href="#" class="remote-element"><img src="{{asset('images/circle-pause-solid.svg')}}" alt="pause"></a>
                                            <a href="#" class="remote-element"><img  src="{{asset('images/circle-play-solid.svg')}}" alt="play"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.modal-confirm')
</x-app-layout>

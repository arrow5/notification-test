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
                        <div class="col-xl-6 offset-xl-3">
                            <h3>Загальні налаштування</h3>
                            <form action="{{route('notifications.store')}}" class="mt-3 needs-validations" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="notificationName" class="form-label">Назва сповіщення</label>
                                    <input type="text" name="name" value="{{old('name')}}" class="form-control" id="notificationName">
                                    @error('name')
                                    <div class="feedback-error">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="notificationInspectionPeriod" class="form-label">Період перевірки нових оголошень (хвилини)</label>
                                    <input type="text" name="inspection_period" value="{{old('inspection_period')}}" class="form-control" id="notificationInspectionPeriod">
                                    @error('inspection_period')
                                    <div class="feedback-error">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3 d-flex align-items-center">
                                    <label for="notificationInspectionPeriod" class="form-label">Будуть перевірятися</label>
                                    <input type="text" name="count_page" value="{{old('count_page')}}" class="form-control w-20 mr-2 ml-2" id="notificationInspectionPeriod">
                                    <label for="notificationInspectionPeriod" class="form-label">перших сторінок</label>
                                    @error('count_page')
                                    <div class="feedback-error">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-check form-switch">
                                    <input class="form-check-input" name="idealita_active" type="checkbox" role="switch" id="idealitaActive">
                                    <label class="form-check-label" for="idealitaActive">Cлідкувати за ідеаліста</label>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="idealista_url" class="form-control hidden" id="idealitaActiveUrl">
                                    @error('idealista_url')
                                    <div class="feedback-error">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" name="olx_active" type="checkbox" role="switch" id="olxActive">
                                    <label class="form-check-label" for="olxActive">Cлідкувати за OLX</label>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="olx_url" value="{{old('olx_url')}}" class="form-control hidden" id="olxActiveUrl">
                                    @error('olx_url')
                                    <div class="feedback-error">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" name="fb_active" type="checkbox" role="switch" id="fbActive">
                                    <label class="form-check-label" for="fbActive">Cлідкувати за FB</label>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="fb_url" value="{{old('fb_url')}}" class="form-control hidden" id="fbActiveUrl">
                                    @error('fb_url')
                                    <div class="feedback-error">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <label>Налаштування каналів відправки повідомлень</label>
                                @foreach($notificationTypes as $notificationType)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="{{$notificationType->id}}" name="notification_type_id" id="notificationType{{$notificationType->id}}">
                                    <label class="form-check-label" for="notificationType{{$notificationType->id}}">
                                        {{$notificationType->name}}
                                    </label>
                                </div>
                                @endforeach
                                @error('notification_type_id')
                                <div class="feedback-error">
                                    {{$message}}
                                </div>
                                @enderror
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

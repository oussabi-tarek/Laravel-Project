<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="container mx-auto px-4 sm:px-8">
                <div class="py-8">
                    <div>
                        <h2 class="text-2xl font-semibold leading-tight">Mes Posts</h2>
                    </div>
                    <div class="-mx-4 w-1000 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                        <div class="inline-block min-w-full  shadow rounded-lg overflow-hidden">
                            <table class="min-w-full w-screen leading-normal">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Titre
                                        </th>
                                       
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                           Description
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(auth()->user()->posts()->withTrashed()->get() as $post)

                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-2/5">
                                            {{$post->title}}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        {{$post->body}}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <a href="{{route('posts.edit',$post->slug)}}" class="py-2 px-4 shadow-md no-underline rounded-full bg-blue text-black font-sans font-semibold text-sm border-blue btn-primary hover:text-white hover:bg-blue-light focus:outline-none active:shadow-none mr-2">editer</a>
                                            @if($post->trashed())
                                            <a href="{{route('posts.restore',$post->slug)}}" class="py-2 px-4 shadow-md no-underline rounded-full bg-blue text-black font-sans font-semibold text-sm border-blue btn-primary hover:text-white hover:bg-blue-light focus:outline-none active:shadow-none mr-2">recuperer</a>
                                        <form id="{{$post->id}}" method="POST" action="{{route('posts.delete',$post->slug)}}">
                                            @csrf
                                            @method('DELETE')
                                            </form>
                                            @else
                                            <form id="{{$post->id}}" method="POST" action="{{route('posts.destroy',$post->slug)}}">
                                                @csrf
                                                @method('DELETE')
                                                </form>

                                            @endif
                                            <button type="submit" onclick="event.preventDefault();
                                                     if(confirm('etes vous sur?')) document.getElementById({{$post->id}}).submit();"
                                                     class="py-2 px-4 shadow-md no-underline rounded-full bg-blue text-black font-sans font-semibold text-sm border-blue btn-primary hover:text-white hover:bg-blue-light focus:outline-none active:shadow-none mr-2">
                                                     @if($post->trashed())
                                                  supprimer definitivement
                                                    @else
                                                    supprimer
                                                     @endif
                                                    </button>
                                        </td>                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
           
          
              
              </table>

            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-jet-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-jet-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

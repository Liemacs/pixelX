@extends('frontend.layouts.master')

@section('content')
    {{-- <div class="login">
        <h1>Login</h1>
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div>
                <input type="email" name="email" id="email" placeholder="Email">
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <input type="password" name="password" id="password" placeholder="Password">
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>

    <div class="register">
        <h1>Register</h1>
        <form action="{{ route('register.submit') }}" method="POST" autocomplete="off">
            {{ csrf_field() }}
            <div>
                <input type="text" name="full_name" id="full_name" placeholder="Full name"
                    value="{{ old('full_name') }}">
                @error('full_name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <input type="text" name="username" id="username" placeholder="Username" value="{{ old('username') }}">
                @error('username')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <input type="email" name="email" id="email" placeholder="Email">
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <input type="password" name="password" id="password" placeholder="Password">
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <input type="password" name="password_confirmation" id="password" placeholder="Confirm password">

            </div>

            <button type="submit">Register</button>
        </form>
    </div> --}}


    <div class="logmod">
        <div class="logmod__wrapper pixel-corners">
            <div class="logmod__container">
                <ul class="logmod__tabs">
                    <li data-tabtar="lgm-2"><a href="#">Login</a></li>
                    <li data-tabtar="lgm-1"><a href="#">Sign Up</a></li>
                </ul>
                <div class="logmod__tab-wrapper">
                    <div class="logmod__tab lgm-1">
                        <div class="logmod__heading">
                            <span class="logmod__heading-subtitle">Enter your personal details <strong>to create an
                                    acount</strong></span>
                        </div>
                        <div class="logmod__form">
                            <form action="{{ route('register.submit') }}" method="POST" accept-charset="utf-8"
                                class="simform">
                                {{ csrf_field() }}
                                <div class="sminputs">
                                    <div class="input full">
                                        <label class="string optional" for="full_name">Full name</label>
                                        <input class="string optional" name="full_name" id="full_name" maxlength="255"
                                            placeholder="Full name" type="text" size="50"
                                            value="{{ old('full_name') }}" />
                                        @error('full_name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="sminputs">
                                    <div class="input full">
                                        <label class="string optional" for="username">Username</label>
                                        <input class="string optional" name="username" id="username" maxlength="255"
                                        placeholder="Username" type="text" size="50"
                                        value="{{ old('username') }}" />
                                        @error('username')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="sminputs">
                                    <div class="input full">
                                        <label class="string optional" for="email">Email*</label>
                                        <input class="string optional" maxlength="255" placeholder="Email" name="email"
                                            id="email" type="email" size="50" />
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="sminputs">
                                    <div class="input string optional">
                                        <label class="string optional" for="password">Password *</label>
                                        <input class="string optional" maxlength="255" name="password" id="password"
                                            placeholder="Password" type="password" size="50" />
                                        @error('password')
                                            <p class="text-danger absolude">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input string optional">
                                        <label class="string optional" for="password_confirmation">Repeat password *</label>
                                        <input class="string optional" name="password_confirmation" maxlength="255"
                                            id="user-pw-repeat" placeholder="Repeat password" type="password"
                                            size="50" />
                                    </div>
                                </div>
                                <div class="simform__actions">
                                    <button class="sumbit pixel-corners-sm" name="commit" type="sumbit">Create
                                        Account</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="logmod__tab lgm-2">
                        <div class="logmod__heading">
                            <span class="logmod__heading-subtitle">Enter your email and password <strong>to sign
                                    in</strong></span>
                        </div>
                        <div class="logmod__form">
                            <form accept-charset="utf-8" class="simform" action="{{ route('login.submit') }}"
                                method="POST">
                                @csrf
                                <div class="sminputs">
                                    <div class="input full">
                                        <label class="string optional" for="user-name">Email*</label>
                                        <input class="string optional" maxlength="255" placeholder="Email" type="email"
                                            size="50" name="email" id="email" />
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="sminputs">
                                    <div class="input full">
                                        <label class="string optional" for="user-pw">Password *</label>
                                        <input class="string optional" maxlength="255" placeholder="Password"
                                            type="password" size="50" name="password" id="password" />
                                        @error('password')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        <span class="hide-password">Show</span>
                                    </div>
                                </div>
                                <div style="margin: 10px 0 0 20px">
                                    <input type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                <div class="simform__actions ">
                                    <button class="sumbit pixel-corners-sm" name="commit" type="sumbit">Log In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var LoginModalController = {
            tabsElementName: ".logmod__tabs li",
            tabElementName: ".logmod__tab",
            inputElementsName: ".logmod__form .input",
            hidePasswordName: ".hide-password",

            inputElements: null,
            tabsElement: null,
            tabElement: null,
            hidePassword: null,

            activeTab: null,
            tabSelection: 0, // 0 - first, 1 - second

            findElements: function() {
                var base = this;

                base.tabsElement = $(base.tabsElementName);
                base.tabElement = $(base.tabElementName);
                base.inputElements = $(base.inputElementsName);
                base.hidePassword = $(base.hidePasswordName);

                return base;
            },

            setState: function(state) {
                var base = this,
                    elem = null;

                if (!state) {
                    state = 0;
                }

                if (base.tabsElement) {
                    elem = $(base.tabsElement[state]);
                    elem.addClass("current");
                    $("." + elem.attr("data-tabtar")).addClass("show");
                }

                return base;
            },

            getActiveTab: function() {
                var base = this;

                base.tabsElement.each(function(i, el) {
                    if ($(el).hasClass("current")) {
                        base.activeTab = $(el);
                    }
                });

                return base;
            },

            addClickEvents: function() {
                var base = this;

                base.hidePassword.on("click", function(e) {
                    var $this = $(this),
                        $pwInput = $this.prev("input");

                    if ($pwInput.attr("type") == "password") {
                        $pwInput.attr("type", "text");
                        $this.text("Hide");
                    } else {
                        $pwInput.attr("type", "password");
                        $this.text("Show");
                    }
                });

                base.tabsElement.on("click", function(e) {
                    var targetTab = $(this).attr("data-tabtar");

                    e.preventDefault();
                    base.activeTab.removeClass("current");
                    base.activeTab = $(this);
                    base.activeTab.addClass("current");

                    base.tabElement.each(function(i, el) {
                        el = $(el);
                        el.removeClass("show");
                        if (el.hasClass(targetTab)) {
                            el.addClass("show");
                        }
                    });
                });

                base.inputElements.find("label").on("click", function(e) {
                    var $this = $(this),
                        $input = $this.next("input");

                    $input.focus();
                });

                return base;
            },

            initialize: function() {
                var base = this;

                base.findElements().setState().getActiveTab().addClickEvents();
            }
        };

        $(document).ready(function() {
            LoginModalController.initialize();
        });
    </script>
@endsection

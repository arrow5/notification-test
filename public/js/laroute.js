(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://localhost',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"sanctum\/csrf-cookie","name":null,"action":"Laravel\Sanctum\Http\Controllers\CsrfCookieController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/user","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard","name":"dashboard","action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"register","name":"register","action":"App\Http\Controllers\Auth\RegisteredUserController@create"},{"host":null,"methods":["POST"],"uri":"register","name":null,"action":"App\Http\Controllers\Auth\RegisteredUserController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"login","name":"login","action":"App\Http\Controllers\Auth\AuthenticatedSessionController@create"},{"host":null,"methods":["POST"],"uri":"login","name":null,"action":"App\Http\Controllers\Auth\AuthenticatedSessionController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"forgot-password","name":"password.request","action":"App\Http\Controllers\Auth\PasswordResetLinkController@create"},{"host":null,"methods":["POST"],"uri":"forgot-password","name":"password.email","action":"App\Http\Controllers\Auth\PasswordResetLinkController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"reset-password\/{token}","name":"password.reset","action":"App\Http\Controllers\Auth\NewPasswordController@create"},{"host":null,"methods":["POST"],"uri":"reset-password","name":"password.update","action":"App\Http\Controllers\Auth\NewPasswordController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"verify-email","name":"verification.notice","action":"App\Http\Controllers\Auth\EmailVerificationPromptController@__invoke"},{"host":null,"methods":["GET","HEAD"],"uri":"verify-email\/{id}\/{hash}","name":"verification.verify","action":"App\Http\Controllers\Auth\VerifyEmailController@__invoke"},{"host":null,"methods":["POST"],"uri":"email\/verification-notification","name":"verification.send","action":"App\Http\Controllers\Auth\EmailVerificationNotificationController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"confirm-password","name":"password.confirm","action":"App\Http\Controllers\Auth\ConfirmablePasswordController@show"},{"host":null,"methods":["POST"],"uri":"confirm-password","name":null,"action":"App\Http\Controllers\Auth\ConfirmablePasswordController@store"},{"host":null,"methods":["POST"],"uri":"logout","name":"logout","action":"App\Http\Controllers\Auth\AuthenticatedSessionController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"notifications","name":"notifications.index","action":"App\Http\Controllers\NotificationController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"notifications\/create","name":"notifications.create","action":"App\Http\Controllers\NotificationController@create"},{"host":null,"methods":["POST"],"uri":"notifications","name":"notifications.store","action":"App\Http\Controllers\NotificationController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"notifications\/{notification}","name":"notifications.show","action":"App\Http\Controllers\NotificationController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"notifications\/{notification}\/edit","name":"notifications.edit","action":"App\Http\Controllers\NotificationController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"notifications\/{notification}","name":"notifications.update","action":"App\Http\Controllers\NotificationController@update"},{"host":null,"methods":["DELETE"],"uri":"notifications\/{notification}","name":"notifications.destroy","action":"App\Http\Controllers\NotificationController@destroy"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                if (this.absolute && this.isOtherHost(route)){
                    return "//" + route.host + "/" + uri + qs;
                }

                return this.getCorrectUrl(uri + qs);
            },

            isOtherHost: function (route){
                return route.host && route.host != window.location.hostname;
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if ( ! this.absolute) {
                    return url;
                }

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);


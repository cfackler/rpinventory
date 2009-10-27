var ChainCollector = function(base) {
    var CLASS = arguments.callee;

    this.then = this.and = this;
    var queue = [], baseObject = base || {};

    this.____ = function(method, args) {
        queue.push({func: method, args: args});
    };

    this.fire = function(base) {
        var object = base || baseObject, method, property;
        for (var i = 0, n = queue.length; i < n; i++) {
            method = queue[i];
            if (object instanceof CLASS) {
                object.____(method.func, method.args);
                continue;
            }
            property = object[method.func];
            object = (typeof property == 'function')
                    ? property.apply(object, method.args)
                    : property;
        }
        return object;
    };
};

ChainCollector.addMethods = function(object) {
    var methods = [], property, i, n, name;
    var self = this.prototype;

    var reservedNames = [], blank = new this();
    for (property in blank) reservedNames.push(property);
    var re = new RegExp('^(?:' + reservedNames.join('|') + ')$');

    for (property in object) {
        if (Number(property) != property)
            methods.push(property);
    }
    if (object instanceof Array) {
        for (i = 0, n = object.length; i < n; i++) {
            if (typeof object[i] == 'string')
                methods.push(object[i]);
        }
    }
    for (i = 0, n = methods.length ; i < n; i++)
        (function(name) {
            if (re.test(name)) return;
            self[name] = function() {
                this.____(name, arguments);
                return this;
            };
        })(methods[i]);

    if (object.prototype)
        this.addMethods(object.prototype);
};
jQuery.fn.wait = function(time) {
  var collector = new ChainCollector(), self = this;
  // Deal with scoping issues...
  var fire = function() { collector.fire(self); };
  setTimeout(fire, Number(time) * 1000);
  return collector;
};

// Then extend ChainCollector with all jQuery's methods
ChainCollector.addMethods(jQuery);


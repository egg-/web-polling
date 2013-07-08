/**
 * $longpolling
 * https://github.com/egg-
 *
 * long polling module based jQuery
 */
var $longpolling = (function($) {
	var module = {};
	var maps = {};

	/**
	 * start long polling
	 * @param {string} uid user defined unique id for distinct polling request.
	 * @param {object} opt
	 */
	module.start = function(uid, opt) {
		var origin_complete = $.isFunction(opt.complete) ? opt.complete : function() {};

		// stop previous polling
		this.stop(uid);
		
		// reset
		maps[uid] = true;
		opt = $.extend({
			timeout: 30000	// default timeout
		}, opt);

		// ref
		// http://techoctave.com/c7/posts/60-simple-long-polling-example-with-javascript-and-jquery
		(function poll() {
			if (maps[uid] == null) {
				return false;
			}

			maps[uid] = $.ajax($.extend(opt, {
				complete: function(xhr, status) {
					origin_complete(xhr, status);
					status != 'abort' && poll();
				}
			}));
		})();

		return maps[uid];
	};

	/**
	 * stop long polling
	 * @param {string} uid user defined unique id for distinct polling request.
	 */
	module.stop = function(uid) {
		maps[uid] && maps[uid].abort();
		maps[uid] = null;

		return true;
	};

	return module;
}(jQuery));
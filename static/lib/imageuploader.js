/**
 * Created by brook on 4/10/15.
 */

(function() {
  var pluploadPath = $('script[src*=plupload]').attr('src').match(/.*\//)[0];
  $.fn.imageUploader = function (options) {
    var args = arguments;
    return this.each(function () {
      var $this = $(this);
      var config;
      // http://www.plupload.com/docs/Options
      var tpl = '<li id="{0}"><div class="img-wrapper" href="javascript:">{1}</div><a class="remove" href="javascript:" title="移除"><i class="icon i-times-circle"></i></a><input type="hidden" name="{2}" value="{3}"/></li>';
      var inst = $this.data('inst.uploader');
      var methods = {
        val: function (files) {
          $.each(files, function (index, item) {
            config.uploadedList.children('.btn-wrapper').before(strbuf(tpl, 'upload' + index, '<img src="' + item.url + '"/>', config.hiddenName, item.path));
          });
        }
      };
      if (inst) {
        config = inst.settings;
        return methods[args[0]].apply(null, [].slice.call(args, 1));
      }
      config = $.extend({
        browse_button: this,
        drop_element: this,
        url: '/demo/upload',
        // multi_selection: true,
        max_file_size: '10mb',
        filters: [
          {title: "Image files", extensions: "jpg,jpeg,gif,png"}
        ],
        file_data_name: 'file',
        runtimes: "html5,flash,silverlight,html4",
        flash_swf_url: pluploadPath + "Moxie.swf",
        silverlight_xap_url: pluploadPath + "Moxie.swf",
        limit: 0,
        btnText: '选择文件',
        hiddenName: 'uploaded[]',
        init: {
          Init: function (up, file) {
            console.debug("pluploader runtime: " + file.runtime);
          },
          FilesAdded: function (up) {
            up.start();
          },
          UploadProgress: function (up, file) {
            if (up.uploadedList) {
              var preview = $('#' + file.id);
              if (!preview.length) {
                var list = up.uploadedList.children('li'); // filter out validator msg-box
                list.filter('.btn-wrapper').before(strbuf(tpl,
                  file.id, file.percent + '%', up.settings.hiddenName, ''));
                if (up.settings.limit && list.length > up.settings.limit) {
                  list.first().remove();
                }
              } else {
                preview.find('.img-wrapper').html(file.percent + '%');
              }
            }
          },
          FileUploaded: function (up, file, info) {
            var res = $.parseJSON(info.response);

            var preview = $('#' + file.id);
            if(res.code === 0) {
              preview.find('input').val(res.data.path).trigger('validate');
              preview.find('.img-wrapper').html(strbuf('<img src="${url}"/>', res.data));
            } else {
              alert(res.msg);
              preview.remove();
              console.error(res);
            }
          },
          Error: function (up, res) {
            $('#' + res.file.id).remove();

            var msg = '上传失败！';
            if (res.code == -600) {
              msg = '上传文件大小超过限制' + up.settings.max_file_size;
            }
            //var validator = $(config.browse_button).closest('form').data('validator');
            //validator && validator.showMsg($('[name=' + config.hiddenName + ']'), msg);
            alert(msg);
            console.warn(res);
          }
        }
      }, $this.data(), options);
      if (config.limit === 1) {
        config.multi_selection = false;
      }

      if ($this.is('ul')) { // if $this is a list
        config.uploadedList = $this;

        // bind remove btn event
        $this.on('click', '.remove', function () {
          $(this).closest('li').remove();
        });

        // add upload btn
        var btnItem = $(strbuf('<li class="btn-wrapper"><a class="img-wrapper" href="javascript:"><i class="icon i-upload"></i> ${btnText}</a></li>', config)).appendTo($this);
        config.browse_button = config.drop_element = btnItem.find('a')[0];

        methods.val(config.value || []);
      }

      var uploader = new plupload.Uploader(config);
      uploader.init();
      if (config.uploadedList) {
        uploader.uploadedList = $(config.uploadedList);

        $this.data('inst.uploader', uploader);
      } else if (config.selectedList) {
        uploader.uploadedList = config.selectedList;
      }
    });
  };
})();

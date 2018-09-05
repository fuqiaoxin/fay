/**
 * Created by fay on 2018/9/5. 前端语言配置
 */

const zh_cn = {
    systemError: '系统错误',
    loginSuccess: '登录成功',
};

const en = {
    systemError: 'System error',
    loginSuccess: 'Login success',
};

const config = {
    'zh_cn': zh_cn,
    'en': en,
};

let lang = function(_lang, key) {

    if (lang && key) {
        if (typeof config[_lang] != 'undefined'){
            return config[_lang][key];
        } else {
          console.log(_lang,key);
        }

    }
}

export { lang }


import Cookie from "js-cookie";
export default {
    auth(to, from, next) {
        const token = Cookie.get('_masterWeb_token');
        //checar validade do token
        if(!token) {
            next('/login');
        }

        console.log(token);

        next();
    },
}
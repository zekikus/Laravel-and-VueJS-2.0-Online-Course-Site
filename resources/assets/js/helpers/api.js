import axios from 'axios';

export function get(url) {
    return axios({
        method: 'GET',
        url:url
    });
}

export function post(data,url) {
    return axios({
        method:'POST',
        data: data,
        url: url
    });
}

export function put(url,data) {
    return axios({
        method: 'PUT',
        data: data,
        url: url
    });
}

export function del(url) {
    return axios({
        method: 'DELETE',
        url: url
    });
}
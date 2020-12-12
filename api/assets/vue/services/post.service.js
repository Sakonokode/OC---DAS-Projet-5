import axios from 'axios';
import authHeader from './auth-header';
import { store } from '../store';

const API_URL = 'https://projet5.sakonokode.dev/api';

class PostService {
    create(data) {
      console.log('post service', data)
      return axios.post(API_URL + '/posts', {
        title: data.title,
        content: data.content,
        author: data.author,
        image: data.media
      },
      {
        headers: authHeader()
      })
      .then(response => {
        return response.data;
      })
      .catch(function(e){
        console.log('can\'t create post', e);
      });
    }
    findAll() {
      return axios.get(API_URL + '/posts', {
        headers: authHeader()
      })
      .catch(function(error) {
        console.log('can\'t find posts', error)
      });
    }
}

export default new PostService();

import axios from 'axios';
import authHeader from './auth-header';
import { router } from '../router';

const API_URL = 'https://projet5.sakonokode.dev/api/posts';

class PostService {
    create(data) {
      return axios.post(API_URL, {
        title: data.title,
        content: data.content,
        author: data.author,
        thumbnail: data.thumbnail
      },
      {
        headers: authHeader()
      })
      .then(response => {
        return response.data;
      });
    }
    findAll() {
      return axios.get(API_URL, {
        headers: authHeader()
      }).catch(function(error) {
        if (error.response && error.response.status === 401) {
          router.push('/api/logout')
        }
      });
    }
}

export default new PostService();

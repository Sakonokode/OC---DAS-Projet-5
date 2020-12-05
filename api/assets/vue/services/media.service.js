import axios from 'axios';
import authHeader from './auth-header';

const API_URL = 'https://projet5.sakonokode.dev/api/media_objects';

class MediaService {
    create(data) {
      return axios.post(API_URL, data,
      {
        headers: authHeader()
      })
      .then(response => {
        console.log('media service SUCCESS', response)
        return response.data;
      })
      .catch(function(e){
        console.log('media service FAILURE!!', e);
        });
    }
}

export default new MediaService();

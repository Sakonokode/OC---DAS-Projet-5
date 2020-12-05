import axios from 'axios';
import authHeader from './auth-header';

const API_URL = 'https://projet5.sakonokode.dev/api/media_objects';

class MediaService {
    create(data) {
      console.log('data', data)
      return axios.post(API_URL, data,
      {
        headers: authHeader()
      })
      .then(response => {
        console.log('SUCCESS', response.data)
        return response.data;
      })
      .catch(function(e){
        console.log('FAILURE!!', e);
        });
    }
}

export default new MediaService();

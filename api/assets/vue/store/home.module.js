import User from '../models/user';
import UserService from '../services/user.service';

const user = JSON.parse(localStorage.getItem('token'));

const initialState = user
  ? { status: { loggedIn: true }, user }
  : { status: { loggedIn: false }, user: null };

export const home = {
  namespaced: true,
  state: initialState,
  actions: {
    documentation(user) {
      return UserService.getDocumentation();
    },
    findPosts(user) {
      return UserService.findPosts();
    },
  },
};
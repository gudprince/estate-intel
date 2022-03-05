export default function({ app, redirect }) {
    const isAuthenticated = app.$cookies.get('isLogin');
    if (!isAuthenticated) {
      redirect('/');
    }
  }
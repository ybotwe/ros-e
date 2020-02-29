export default class Gate{

    constructor(user){
        this.user=user;
    }

    isAdmin(){
        return this.user.role === 'admin';
    }

    isUser(){
        return this.user.role === 'user';
    }

    isAuthor(){
        return this.user.role === 'author';
    }

    canManage(){
        return this.user.role === 'author' || this.user.role === 'admin';
    }
}
import { API } from './index';

export default {
    getCategories: () => API.get('admin/categories/list'),
}

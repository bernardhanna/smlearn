// services.js
export const fetchCourses = async () => {
    const response = await fetch('https://smlearn.test/api/courses');
    const data = await response.json();
    return data;
};

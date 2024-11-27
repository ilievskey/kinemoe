import "./bootstrap";

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('sidebar-toggle').addEventListener('click', function () {
        document.getElementById('dash-side').classList.toggle('sidebar-collapsed');
        document.getElementById('dash-content').classList.toggle('full-width');
    });

    //ajax query filler/loader and chart info extractor
    function loadContent(url, elementId) {
        fetch(url)
            .then(response => response.text())
            .then(html => {
                document.getElementById(elementId).innerHTML = html;
                //actual chart data extraction from data-posts-*
                if (url.includes('admin/home')) {
                    const postsCount = parseInt(html.match(/data-posts-count="(\d+)"/)[1]);
                    const commentsCount = parseInt(html.match(/data-comments-count="(\d+)"/)[1]);
                    const likesCount = parseInt(html.match(/data-likes-count="(\d+)"/)[1]);
                    loadChart(postsCount, commentsCount, likesCount);
                }
            })
            .catch(error => console.error('Error loading content:', error));
    }

    //chart design and info receiver
    function loadChart(postsCount, commentsCount, likesCount) {
        const ctx = document.getElementById('statsChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Posts', 'Comments', 'Likes'],
                datasets: [{
                    // label: 'KineMoe Stats',
                    data: [postsCount, commentsCount, likesCount],
                    backgroundColor: [
                        'rgba(64, 46, 122, 1)',
                        'rgba(75, 112, 245, 1)',
                        'rgba(61, 194, 236, 1)',
                    ],
                    borderColor: [
                        'rgba(64, 46, 122, .5)',
                        'rgba(75, 112, 245, .5)',
                        'rgba(61, 194, 236, .5)',
                    ],
                    borderWidth: 1
                }]
            },
            options:{
                plugins:{
                    legend:{
                        labels:{
                            font:{
                                size: 16
                            }
                        }
                    }
                }
            }
        });
    }

    //get ajax loads, await click and fill&load request from [data-url]
    document.querySelectorAll('a[data-url]').forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            document.querySelectorAll('a[data-url]').forEach(link => {
                link.classList.remove('active');
            });
            this.classList.add('active');
            const url = this.getAttribute('data-url');
            loadContent(url, 'dash-content');
        });
    });

    //auto load home-link
    const homeUrl = document.getElementById('home-link').getAttribute('data-url');
    loadContent(homeUrl, 'dash-content');
});

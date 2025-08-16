function loadScriptIfNotExists(src, callback) {
  console.log("🔍 Memeriksa apakah script sudah dimuat:", src);

  const oldScript = document.querySelector(`script[src="${src}"]`);
  if (oldScript) {
    console.log("♻️ Script sudah ada, akan dihapus dan dimuat ulang:", src);
    oldScript.remove();
  }

  const script = document.createElement('script');
  script.src = src + '?v=' + Date.now(); // cache buster
  script.onload = () => {
    console.log("✅ Script berhasil dimuat:", src);
    if (callback) callback();
  };
  script.onerror = () => {
    console.error("❌ Gagal memuat script:", src);
  };
  document.body.appendChild(script);
}

document.querySelectorAll('[data-page]').forEach(link => {
  link.addEventListener('click', function (e) {
    e.preventDefault();

    let page = this.getAttribute('data-page');
    if (!page.includes('?')) {
      page += '?embed=1';
    } else if (!page.includes('embed=1')) {
      page += '&embed=1';
    }

    fetch(page)
      .then(res => res.text())
      .then(html => {
        document.getElementById('content-area').innerHTML = html;
        setActiveLink(this);

        // Loader script sesuai halaman
        if (page.includes('circle/create')) {
          loadScriptIfNotExists('/js/circle/create_circle.js', () => {
            if (typeof initCreateCircleForm === 'function') {
              initCreateCircleForm();
            }
          });
        }

        if (page.includes('circle/join')) {
          loadScriptIfNotExists('/js/circle/join_circle.js', () => {
            if (typeof initJoinCircleButtons === 'function') {
              initJoinCircleButtons();
            }
          });
        }

        if (page.includes('circle/view')) {
          loadScriptIfNotExists('/js/circle/view_circle.js', () => {
            if (typeof initViewCircleSearch === 'function') initViewCircleSearch();
            if (typeof initCancelJoinRequest === 'function') initCancelJoinRequest();
          });
        }

        if (page.includes('friend/search')) {
          loadScriptIfNotExists('/js/friend/search_friend.js', () => {
            let tries = 0;
            const interval = setInterval(() => {
              if (typeof window.initSearchFriendForm === 'function') {
                window.initSearchFriendForm();
                clearInterval(interval);
              } else if (tries++ > 10) {
                clearInterval(interval);
              }
            }, 100);
          });
        }

        if (page.includes('friend/requests')) {
          loadScriptIfNotExists('/js/friend/friend_request.js', () => {
            setTimeout(() => {
              if (typeof window.initFriendRequestHandler === 'function') {
                window.initFriendRequestHandler();
              }
            }, 100);
          });
        }

        if (page.includes('friend/list')) {
          loadScriptIfNotExists('/js/friend/friend_list.js', () => {
            console.log("✅ friend_list.js sudah dimuat, memulai polling...");
            let tries = 0;
            const interval = setInterval(() => {
              if (typeof window.initFriendListHandler === 'function') {
                console.log("✅ initFriendListHandler ditemukan dan dipanggil");
                window.initFriendListHandler();
                clearInterval(interval);
              } else if (tries++ > 10) {
                console.warn("❌ initFriendListHandler tidak ditemukan setelah 1 detik.");
                clearInterval(interval);
              }
            }, 100);
          });
        }

        // Tutup sidebar mobile jika terbuka
        const sidebar = bootstrap.Offcanvas.getInstance(document.getElementById('mobileSidebar'));
        if (sidebar) sidebar.hide();
      });
  });
});

function setActiveLink(clickedLink) {
  const allLinks = document.querySelectorAll('.sidebar-link');
  const clickedHref = clickedLink.getAttribute('data-page').split('?')[0];

  allLinks.forEach(link => {
    const href = link.getAttribute('data-page').split('?')[0];
    if (href === clickedHref) {
      link.classList.add('active');
    } else {
      link.classList.remove('active');
    }
  });
}

// 🔹 Auto-load halaman profil jika hash #profile
document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const pageToLoad = urlParams.get('page');

    if (pageToLoad) {
        fetch(pageToLoad + '?embed=1')
            .then(res => res.text())
            .then(html => {
                document.getElementById('content-area').innerHTML = html;
            });
    }
});
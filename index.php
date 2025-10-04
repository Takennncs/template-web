<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>takenncsdevs</title>
  <meta name="description" content="Breakingsf.ee, takenncs, devs, template ucp for use" />
  <style>
     :root {
      --primary: #1a1a2e;
      --secondary: #16213e;
      --accent: #ff7b00;
      --accent-light: #ff9d42;
      --text: #f1f1f1;
      --text-secondary: #b8b8b8;
      --card-bg: rgba(255, 255, 255, 0.05);
      --transition: all 0.3s ease;
    }
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    html {
      scroll-behavior: smooth;
    }
    
    body {
      background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
      color: var(--text);
      line-height: 1.6;
      overflow-x: hidden;
    }
    
    .container {
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }
    
    /* Header stiilid */
    header {
      background: rgba(22, 33, 62, 0.9);
      backdrop-filter: blur(10px);
      position: fixed;
      width: 100%;
      z-index: 1000;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
      transition: var(--transition);
    }
    
    header .container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 20px;
    }
    
    .brand {
      display: flex;
      align-items: center;
      gap: 15px;
    }
    
    .logo {
      width: 50px;
      height: 50px;
      background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      font-size: 1.5rem;
      box-shadow: 0 4px 15px rgba(255, 123, 0, 0.3);
      transition: var(--transition);
    }
    
    .logo:hover {
      transform: rotate(10deg) scale(1.1);
    }
    
    .brand-text h1 {
      font-size: 1.5rem;
      margin-bottom: 5px;
    }
    
    .brand-text p {
      font-size: 0.8rem;
      color: var(--text-secondary);
    }
    
    nav {
      display: flex;
      align-items: center;
      gap: 25px;
    }
    
    .nav-link {
      color: var(--text);
      text-decoration: none;
      font-weight: 500;
      position: relative;
      padding: 5px 0;
      transition: var(--transition);
    }
    
    .nav-link:after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: 0;
      left: 0;
      background: var(--accent);
      transition: var(--transition);
    }
    
    .nav-link:hover {
      color: var(--accent);
    }
    
    .nav-link:hover:after {
      width: 100%;
    }
    
    .cta-link {
      background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
      color: white;
      padding: 10px 20px;
      border-radius: 30px;
      text-decoration: none;
      font-weight: 600;
      box-shadow: 0 4px 15px rgba(255, 123, 0, 0.3);
      transition: var(--transition);
    }
    
    .cta-link:hover {
      transform: translateY(-3px);
      box-shadow: 0 7px 20px rgba(255, 123, 0, 0.4);
    }
    
    .hero {
      min-height: 100vh;
      display: flex;
      align-items: center;
      background: linear-gradient(rgba(26, 26, 46, 0.8), rgba(22, 33, 62, 0.8)), url('png/1.png') no-repeat center center/cover;
      padding-top: 80px;
      text-align: center;
    }
    
    .hero h2 {
      font-size: 3.5rem;
      margin-bottom: 20px;
      line-height: 1.2;
    }
    
    .hero p {
      font-size: 1.2rem;
      max-width: 700px;
      margin: 0 auto 30px;
      color: var(--text-secondary);
    }
    
    .hero-buttons {
      display: flex;
      gap: 15px;
      justify-content: center;
      flex-wrap: wrap;
    }
    
    .btn {
      padding: 12px 30px;
      border-radius: 30px;
      text-decoration: none;
      font-weight: 600;
      transition: var(--transition);
      display: inline-block;
    }
    
    .btn-primary {
      background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
      color: white;
      box-shadow: 0 4px 15px rgba(255, 123, 0, 0.3);
    }
    
    .btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 7px 20px rgba(255, 123, 0, 0.4);
    }
    
    .btn-secondary {
      background: transparent;
      color: var(--text);
      border: 2px solid rgba(255, 255, 255, 0.2);
    }
    
    .btn-secondary:hover {
      background: rgba(255, 255, 255, 0.1);
      border-color: rgba(255, 255, 255, 0.3);
    }
    
    .section-title {
      text-align: center;
      margin-bottom: 60px;
    }
    
    .section-title h2 {
      font-size: 2.5rem;
      margin-bottom: 15px;
      position: relative;
      display: inline-block;
    }
    
    .section-title h2:after {
      content: '';
      position: absolute;
      width: 70px;
      height: 3px;
      background: var(--accent);
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
    }
    
    .section-title p {
      color: var(--text-secondary);
      max-width: 600px;
      margin: 0 auto;
    }
    
    .features {
      padding: 100px 0;
    }
    
    .features-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
    }
    
    .feature-card {
      background: var(--card-bg);
      border-radius: 15px;
      padding: 30px;
      text-align: center;
      transition: var(--transition);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.05);
      position: relative;
      overflow: hidden;
    }
    
    .feature-card:before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, rgba(255, 123, 0, 0.1) 0%, rgba(255, 157, 66, 0.05) 100%);
      opacity: 0;
      transition: var(--transition);
    }
    
    .feature-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }
    
    .feature-card:hover:before {
      opacity: 1;
    }
    
    .feature-icon {
      font-size: 3rem;
      margin-bottom: 20px;
      display: inline-block;
      transition: var(--transition);
    }
    
    .feature-card:hover .feature-icon {
      transform: scale(1.2);
    }
    
    .feature-card h3 {
      font-size: 1.5rem;
      margin-bottom: 15px;
    }
    
    .feature-card p {
      color: var(--text-secondary);
    }
    
    .how-to-start {
      padding: 100px 0;
      background: rgba(0, 0, 0, 0.1);
    }
    
    .steps {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 30px;
    }
    
    .step {
      background: var(--card-bg);
      border-radius: 15px;
      padding: 30px;
      text-align: center;
      transition: var(--transition);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.05);
      position: relative;
    }
    
    .step:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }
    
    .step-number {
      width: 50px;
      height: 50px;
      background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      font-size: 1.2rem;
      margin: 0 auto 20px;
      box-shadow: 0 4px 15px rgba(255, 123, 0, 0.3);
    }
    
    .step h3 {
      font-size: 1.3rem;
      margin-bottom: 15px;
    }
    
    .step p {
      color: var(--text-secondary);
    }
    
    .server-info {
      padding: 100px 0;
    }
    
    .info-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 30px;
    }
    
    .info-card {
      background: var(--card-bg);
      border-radius: 15px;
      padding: 30px;
      text-align: center;
      transition: var(--transition);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    .info-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }
    
    .info-card h3 {
      font-size: 1.3rem;
      margin-bottom: 15px;
      color: var(--accent);
    }
    
    .info-card p {
      font-size: 1.1rem;
      font-weight: 600;
    }
    
    footer {
      background: rgba(0, 0, 0, 0.3);
      padding: 70px 0 20px;
    }
    
    .footer-content {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 40px;
      margin-bottom: 50px;
    }
    
    .footer-column h3 {
      font-size: 1.3rem;
      margin-bottom: 20px;
      color: var(--accent);
    }
    
    .footer-column p {
      color: var(--text-secondary);
    }
    
    .footer-links {
      list-style: none;
    }
    
    .footer-links li {
      margin-bottom: 10px;
    }
    
    .footer-links a {
      color: var(--text-secondary);
      text-decoration: none;
      transition: var(--transition);
    }
    
    .footer-links a:hover {
      color: var(--accent);
      padding-left: 5px;
    }
    
    .footer-bottom {
      text-align: center;
      padding-top: 20px;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      color: var(--text-secondary);
      font-size: 0.9rem;
    }
    
    .pop-out {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }
    
    .pop-out.visible {
      opacity: 1;
      transform: translateY(0);
    }
    
    @media (max-width: 768px) {
      header .container {
        flex-direction: column;
        gap: 15px;
      }
      
      nav {
        flex-wrap: wrap;
        justify-content: center;
      }
      
      .hero h2 {
        font-size: 2.5rem;
      }
      
      .hero p {
        font-size: 1rem;
      }
      
      .hero-buttons {
        flex-direction: column;
        align-items: center;
      }
      
      .btn {
        width: 100%;
        max-width: 250px;
      }
      
      .section-title h2 {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body>
  <header>
    <div class="container">
      <div class="brand">
        <div class="logo">BSF</div>
        <div class="brand-text">
        </div>
      </div>
      <nav aria-label="1Main">
        <!-- <a href="login.php" class="cta-link">Liitu kohe</a> -->
      </nav>
    </div>
  </header>
  
  <section class="hero">
    <div class="container">
      <h2 class="pop-out">
        Tere tulemast <span style="color: var(--accent);">RP nimi</span>
      </h2>
      <p class="pop-out">Pane siia oma tekst</p>
      <div class="hero-buttons">
        <a href="login.php" class="btn btn-primary pop-out">Liitu kohe</a>
      </div>
    </div>
  </section>

      <div class="footer-bottom">
        <p>&copy; takenncsdevs / free use</p>
      </div>
    </div>
  </footer>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const popOutElements = document.querySelectorAll('.pop-out');
      
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('visible');
          }
        });
      }, { threshold: 0.1 });
      
      popOutElements.forEach(element => {
        observer.observe(element);
      });
      
      const header = document.querySelector('header');
      window.addEventListener('scroll', () => {
        if (window.scrollY > 100) {
          header.style.background = 'rgba(22, 33, 62, 0.95)';
          header.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.3)';
        } else {
          header.style.background = 'rgba(22, 33, 62, 0.9)';
          header.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.2)';
        }
      });
    });
  </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>FMS — Empowering Farmers</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Nunito:wght@700;800&display=swap" rel="stylesheet">
  <style>
    :root{
      --primary:#2a9d8f;
      --primary-600:#21867a;
      --accent:#ffb703;
      --text:#1e293b;
      --muted:#475569;
      --card:#ffffff;
      --border:#e2e8f0;
      --shadow:0 4px 12px rgba(0,0,0,.08);
      --radius:16px;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial;
      color:var(--text);
      background:url('farm-background.jpg') no-repeat center center fixed;
      background-size:cover;
      line-height:1.6;
    }
    a{color:inherit;text-decoration:none}
    .container{max-width:1200px;margin:auto;padding:20px}

    header{
      position:sticky;top:0;z-index:50;
      background:#ffffffcc;
      backdrop-filter:blur(8px);
      border-bottom:1px solid var(--border);
    }
    .nav{display:flex;align-items:center;justify-content:space-between;padding:14px 0;}
    .brand{display:flex;align-items:center;gap:10px}
    .logo{width:40px;height:40px;border-radius:10px;background:linear-gradient(135deg,var(--primary),#56c9bb);
      display:grid;place-items:center;color:#fff;font-weight:800;font-family:Nunito}
    .brand h1{font-family:Nunito;font-weight:800;font-size:20px;margin:0;color:var(--primary)}
    .menu{display:flex;gap:10px}
    .btn{padding:10px 16px;border-radius:12px;border:1px solid var(--border);background:#ffffffcc;
      transition:.25s ease;font-weight:600;color:var(--text)}
    .btn:hover{background:#e2e8f0}
    .btn.primary{background:var(--primary);color:#fff;border:none;}
    .btn.primary:hover{background:var(--primary-600)}

    .hero{border-radius:24px;padding:50px 28px;margin-top:18px;background:#ffffffcc;
      border:1px solid var(--border);box-shadow:var(--shadow)}
    .hero-grid{display:grid;grid-template-columns:1fr;gap:30px;align-items:center}
    .eyebrow{display:inline-block;background:#d1fae5;padding:6px 12px;border-radius:999px;font-size:12px;font-weight:700;color:var(--primary)}
    .hero h2{font-family:Nunito;font-weight:800;font-size:36px;line-height:1.2;margin:16px 0 12px;color:var(--text)}
    .hero p{color:var(--muted);margin:0 0 16px}
    .cta{display:flex;gap:12px;flex-wrap:wrap}

    section{margin-top:40px}
    .section-title{font-family:Nunito;font-size:28px;font-weight:800;margin:0 0 14px;color:var(--text)}
    .grid{display:grid;grid-template-columns:repeat(12,1fr);gap:16px}
    .card{grid-column:span 12;background:var(--card);border:1px solid var(--border);border-radius:16px;padding:20px;box-shadow:var(--shadow)}
    .card h3{margin:0 0 8px;font-size:20px;font-weight:700;color:var(--text)}
    .card p{color:var(--muted);margin:0}

    .feature{display:flex;gap:12px}
    .icon{width:38px;height:38px;border-radius:10px;background:#f1f5f9;display:grid;place-items:center;flex:0 0 38px;font-size:18px}
    .features .card:hover{transform:translateY(-4px);transition:.25s ease}

    footer{margin-top:40px;padding:20px 0;color:var(--muted);border-top:1px solid var(--border);text-align:center;background:#ffffffcc}

    @media(max-width:900px){.hero-grid{grid-template-columns:1fr}}
  </style>
</head>
<body>
  <header>
    <div class="container nav">
      <div class="brand">
        <div class="logo">F</div>
        <h1>Farmers Management System</h1>
      </div>
      <nav class="menu">
        <a class="btn" href="select_registration.html">Register</a>
        <a class="btn primary" href="login.php">Login</a>
      </nav>
    </div>
  </header>

  <main class="container">
    <section class="hero">
      <div class="hero-grid">
        <div>
          <span class="eyebrow">Sustainable tools for modern farming</span>
          <h2>Empowering farmers with data, resources & trusted connections</h2>
          <p>Make smarter decisions on what to plant, when to sell, and how to grow. FMS brings market prices, inputs, training, and secure transactions into one simple dashboard.</p>
          <div class="cta">
            <a class="btn primary" href="#features">Explore Features</a>
            <a class="btn" href="#about">Learn More</a>
          </div>
        </div>
      </div>
    </section>

    <section id="about">
      <h2 class="section-title">About FMS</h2>
      <div class="card">
        <p><strong>Farmers Management System</strong> is a comprehensive platform designed to equip farmers with essential tools and reliable partners—so every season is more productive, profitable, and sustainable.</p>
      </div>
    </section>

    <section id="features" class="features">
      <h2 class="section-title">Key Features</h2>
      <div class="grid">
        <div class="card feature" style="grid-column:span 6">
          <div class="icon">📈</div>
          <div><h3>Market Insights</h3><p>Stay updated with real-time crop prices and trends to make informed selling decisions.</p></div>
        </div>
        <div class="card feature" style="grid-column:span 6">
          <div class="icon">🌱</div>
          <div><h3>Resource Management</h3><p>Connect with organizations for seeds, fertilizers, equipment, and training programs.</p></div>
        </div>
        <div class="card feature" style="grid-column:span 6">
          <div class="icon">🤝</div>
          <div><h3>Wholesaler–Supplier Network</h3><p>Access a curated directory for trusted, secure transactions.</p></div>
        </div>
        <div class="card feature" style="grid-column:span 6">
          <div class="icon">✨</div>
          <div><h3>Personalized Recommendations</h3><p>Get tailored advice for planting, harvesting, and selling based on location and season.</p></div>
        </div>
        <div class="card feature" style="grid-column:span 6">
          <div class="icon">💳</div>
          <div><h3>Efficient Transactions</h3><p>Track financial interactions with clear summaries and downloadable receipts.</p></div>
        </div>
        <div class="card feature" style="grid-column:span 6">
          <div class="icon">🗣️</div>
          <div><h3>Feedback-Driven Growth</h3><p>Tell us what works and what doesn’t—we’ll keep improving for you.</p></div>
        </div>
      </div>
    </section>

    <section id="mission">
      <h2 class="section-title">Our Mission</h2>
      <div class="card">
        <p>We’re building a thriving agricultural community by delivering actionable insights, streamlined connections, and the support farmers need to achieve financial and operational success.</p>
      </div>
    </section>
  </main>

  <footer>
    <div class="container">
      <small>© 2025 Farmers Management System</small>
    </div>
  </footer>
</body>
</html>

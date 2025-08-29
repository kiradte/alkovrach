<?php
?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>ДЕТОКС — частная наркологическая клиника</title>
  <meta name="description" content="Срочный вызов врача-нарколога на дом. Анонимно, 24/7. Первичная консультация — бесплатно." />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>

  <div class="topbar" role="note" aria-label="Предупреждение 18+">
    <div class="topbar__inner">
      <span class="topbar__text">
        Имеются противопоказания, необходимо проконсультироваться со специалистом 18+
      </span>
    </div>
  </div>

  <header class="header" role="banner">
    <div id="top"></div>
    <div class="container header__row">

      <a class="logo logo--image-only" href="#top" aria-label="ДЕТОКС — на главную">
        <picture>
          <source srcset="assets/img/logo-full.png 1x, assets/img/logo-full@2x.png 2x" type="image/webp">
          <img
            class="logo__img"
            src="assets/img/logo-full.png"
            srcset="assets/img/logo-full@2x.png 2x"
            width="170" height="45"
            alt=""
            aria-hidden="true"
            decoding="async" loading="eager">
        </picture>
      </a>

      <nav class="nav" aria-label="Главное меню">
        <ul class="nav__list">
          <li><a href="#services">Услуги</a></li>
          <li><a href="#steps">Этапы лечения</a></li>
          <li><a href="#about">О нас</a></li>
          <li><a href="#reviews">Отзывы</a></li>
          <li><a href="#contacts">Контакты</a></li>
        </ul>
      </nav>

      <div class="header__cta">
        <div class="header__phonebox" aria-label="Контакты клиники">
          <a class="header__phone" href="tel:+79061800041">8&nbsp;(906)&nbsp;180-00-41</a>
          <span class="header__work">Работаем 24/7</span>
        </div>

        <button class="btn btn--primary js-open-callback" type="button">
          Заказать звонок
        </button>

        <button
          class="burger js-burger"
          type="button"
          aria-label="Открыть меню"
          aria-controls="mobile-menu"
          aria-expanded="false">
          <span class="burger__bar" aria-hidden="true"></span>
        </button>
      </div>
    </div>
  </header>

  <div id="mobile-menu" class="mobile-menu" hidden>
    <div class="mobile-menu__panel" role="dialog" aria-modal="true" aria-label="Мобильное меню">
      <nav class="mobile-nav" aria-label="Мобильное меню">
        <ul class="mobile-nav__list">
          <li><a href="#services">Услуги</a></li>
          <li><a href="#steps">Этапы лечения</a></li>
          <li><a href="#about">О нас</a></li>
          <li><a href="#reviews">Отзывы</a></li>
          <li><a href="#contacts">Контакты</a></li>
        </ul>
      </nav>

      <button class="mobile-menu__close js-burger-close" type="button" aria-label="Закрыть меню"></button>
      <div class="mobile-menu__footer">
        <div class="header__phonebox mobile-menu__contacts" aria-label="Контакты клиники">
          <a class="header__phone" href="tel:+79061800041">8&nbsp;(906)&nbsp;180-00-41</a>
          <span class="header__work">Работаем 24/7</span>
        </div>
        <button class="btn btn--primary js-open-callback" type="button">
          Заказать звонок
        </button>
      </div>
    </div>

    <div class="mobile-menu__backdrop js-burger-close" aria-hidden="true"></div>
  </div>

  <main id="top">

    <section id="hero" class="nh-hero" aria-label="Срочный вызов врача-нарколога">
      <div class="nh-hero__bg" aria-hidden="true">
        <img
          class="nh-hero__bg-img"
          src="assets/img/hero/hero-bg-blur.png"
          srcset="assets/img/hero/hero-bg-blur@2x.png 2"
          width="1244" height="830"
          alt=""
          decoding="async" loading="lazy">
      </div>

      <div class="nh-hero__doctor" aria-hidden="true">
        <img
          class="nh-hero__doctor-img"
          src="assets/img/hero/hero-doctor.png"
          srcset="assets/img/hero/hero-doctor@2x.png 2x"
          width="454" height="1136"
          alt=""
          decoding="async" loading="eager" fetchpriority="high">
      </div>

      <div class="container nh-hero__container">
        <div class="nh-hero__content">
          <h1 class="nh-hero__title">Срочный вызов<br>врача-нарколога</h1>

          <ul class="nh-hero__list" role="list">
            <li class="nh-hero__item">
              <span class="nh-hero__bullet" aria-hidden="true">
                 <img class="nh-hero__bullet-img"
                      src="assets/img/ui/check.png"
                      width="25" height="25" alt="">
              </span>
              Сохраняем анонимность, не требуем паспорт и не ставим на учёт
            </li>
            <li class="nh-hero__item">
              <span class="nh-hero__bullet" aria-hidden="true">
                <img class="nh-hero__bullet-img"
                  src="assets/img/ui/check.png"
                  width="25" height="25" alt="">
              </span>
              Помощь квалифицированного врача на дому
            </li>
            <li class="nh-hero__item">
              <span class="nh-hero__bullet" aria-hidden="true">
                <img class="nh-hero__bullet-img"
                     src="assets/img/ui/check.png"
                     width="25" height="25" alt="">
              </span>
              Приедем на адрес за 20 минут
            </li>
            <li class="nh-hero__item">
              <span class="nh-hero__bullet" aria-hidden="true">
                <img class="nh-hero__bullet-img"
                     src="assets/img/ui/check.png"
                     width="25" height="25" alt="">
              </span>
              Первичная консультация — бесплатно
            </li>
          </ul>

          <div class="nh-hero__actions">
            <a href="#callback" class="btn btn--primary btn--lg js-open-callback">Получить помощь</a>
            <a href="#callback" class="btn btn--outline btn--lg js-open-callback">Заказать звонок</a>
          </div>
        </div>
      </div>
    </section>

    <section id="services" class="services" aria-label="Наши услуги">
      <div class="container">
        <h2 class="section-title services__title">Наши услуги</h2>

        <div class="services__grid">

          <article class="service-card">
            <figure class="service-card__media">
              <picture>
                <source type="image/webp"
                        srcset="assets/img/services/standard@1x.png 1x, assets/img/services/standard@2x.png 2x"
                        sizes="(max-width: 980px) 50vw, (max-width: 640px) 100vw, 360px">
                <img src="assets/img/services/standard.png"
                     srcset="assets/img/services/standard@2x.png 2x"
                     sizes="(max-width: 980px) 50vw, (max-width: 640px) 100vw, 360px"
                     alt="Стандартная терапия — постановка капельницы и наблюдение врача"
                     decoding="async" fetchpriority="high">
              </picture>
            </figure>

            <div class="service-card__body">
              <h3 class="service-card__title">Стандартная терапия</h3>
              <p class="service-card__desc">
                Для облегчения похмельного синдрома и прерывания запоя. А также при алкогольном отравлении.
              </p>
              <div class="service-card__actions">
                <a href="#cta" class="btn btn--outline" aria-label="Цена услуги: от 2 400 рублей">от 2&#8239;400&nbsp;₽</a>
                <a href="#"
                   class="btn btn--primary js-open-callback"
                   aria-controls="callback-modal"
                   aria-label="Стандартная терапия — начать лечение"
                   data-modal-title="Стандартная терапия — начать лечение"
                   data-source="services:standard">Начать лечение</a>
              </div>
            </div>
          </article>

          <article class="service-card">
            <figure class="service-card__media">
              <picture>
                <source type="image/webp"
                        srcset="assets/img/services/boost@1x.png 1x, assets/img/services/boost@2x.png 2x"
                        sizes="(max-width: 980px) 50vw, (max-width: 640px) 100vw, 360px">
                <img src="assets/img/services/boost.jpg"
                     srcset="assets/img/services/boost@2x.jpg 2x"
                     sizes="(max-width: 980px) 50vw, (max-width: 640px) 100vw, 360px"
                     alt="Усиленная терапия — расширенный курс дезинтоксикации"
                     loading="lazy" decoding="async">
              </picture>
            </figure>

            <div class="service-card__body">
              <h3 class="service-card__title">Усиленная терапия</h3>
              <p class="service-card__desc">
                Рекомендуется для облегчения похмелья и прерывания запоев длительностью до недели.
              </p>
              <div class="service-card__actions">
                <a href="#cta" class="btn btn--outline">от 5&#8239;800&nbsp;₽</a>
                <a href="#"
                   class="btn btn--primary js-open-callback"
                   aria-controls="callback-modal"
                   aria-label="Усиленная терапия — начать лечение"
                   data-modal-title="Усиленная терапия — начать лечение"
                   data-source="services:boost">Начать лечение</a>
              </div>
            </div>
          </article>

          <article class="service-card">
            <figure class="service-card__media">
              <picture>
                <source type="image/webp"
                        srcset="assets/img/services/recover-plus@1x.png 1x, assets/img/services/recover-plus@2x.png 2x"
                        sizes="(max-width: 980px) 50vw, (max-width: 640px) 100vw, 360px">
                <img src="assets/img/services/recover-plus.jpg"
                     srcset="assets/img/services/recover-plus@2x.jpg 2x"
                     sizes="(max-width: 980px) 50vw, (max-width: 640px) 100vw, 360px"
                     alt="Восстановление+ — комплексная программа восстановления"
                     loading="lazy" decoding="async">
              </picture>
            </figure>

            <div class="service-card__body">
              <h3 class="service-card__title">Восстановление+</h3>
              <p class="service-card__desc">
                Для облегчения похмельного синдрома и прерывания запоя. А также при алкогольном отравлении.
              </p>
              <div class="service-card__actions">
                <a href="#cta" class="btn btn--outline">от 15&#8239;800&nbsp;₽</a>
                <a href="#"
                   class="btn btn--primary js-open-callback"
                   aria-controls="callback-modal"
                   aria-label="Восстановление+ — начать лечение"
                   data-modal-title="Восстановление+ — начать лечение"
                   data-source="services:recover-plus">Начать лечение</a>
              </div>
            </div>
          </article>

          <article class="service-card">
            <figure class="service-card__media">
              <picture>
                <source type="image/webp"
                        srcset="assets/img/services/max@1x.png 1x, assets/img/services/max@2x.png 2x"
                        sizes="(max-width: 980px) 50vw, (max-width: 640px) 100vw, 360px">
                <img src="assets/img/services/max.jpg"
                     srcset="assets/img/services/max@2x.jpg 2x"
                     sizes="(max-width: 980px) 50vw, (max-width: 640px) 100vw, 360px"
                     alt="Максимальная терапия — интенсивная детоксикация"
                     loading="lazy" decoding="async">
              </picture>
            </figure>

            <div class="service-card__body">
              <h3 class="service-card__title">Максимальная терапия</h3>
              <p class="service-card__desc">
                Для облегчения похмельного синдрома и прерывания запоя. А также при алкогольном отравлении.
              </p>
              <div class="service-card__actions">
                <a href="#cta" class="btn btn--outline">от 18&#8239;800&nbsp;₽</a>
                <a href="#"
                   class="btn btn--primary js-open-callback"
                   aria-controls="callback-modal"
                   aria-label="Максимальная терапия — начать лечение"
                   data-modal-title="Максимальная терапия — начать лечение"
                   data-source="services:max">Начать лечение</a>
              </div>
            </div>
          </article>

          <article class="service-card">
            <figure class="service-card__media">
              <picture>
                <source type="image/webp"
                        srcset="assets/img/services/coding-plus@1x.png 1x, assets/img/services/coding-plus@2x.png 2x"
                        sizes="(max-width: 980px) 50vw, (max-width: 640px) 100vw, 360px">
                <img src="assets/img/services/coding-plus.jpg"
                     srcset="assets/img/services/coding-plus@2x.jpg 2x"
                     sizes="(max-width: 980px) 50vw, (max-width: 640px) 100vw, 360px"
                     alt="Кодирование+ — противорецидивная поддержка"
                     loading="lazy" decoding="async">
              </picture>
            </figure>

            <div class="service-card__body">
              <h3 class="service-card__title">Кодирование+</h3>
              <p class="service-card__desc">
                Рекомендуется для облегчения похмелья и прерывания запоев длительностью до недели.
              </p>
              <div class="service-card__actions">
                <a href="#cta" class="btn btn--outline">от 3&#8239;200&nbsp;₽</a>
                <a href="#"
                   class="btn btn--primary js-open-callback"
                   aria-controls="callback-modal"
                   aria-label="Кодирование+ — начать лечение"
                   data-modal-title="Кодирование+ — начать лечение"
                   data-source="services:coding-plus">Начать лечение</a>
              </div>
            </div>
          </article>

          <article class="service-card">
            <figure class="service-card__media">
              <picture>
                <source type="image/webp"
                        srcset="assets/img/services/doctor-home@1x.png 1x, assets/img/services/doctor-home@2x.png 2x"
                        sizes="(max-width: 980px) 50vw, (max-width: 640px) 100vw, 360px">
                <img src="assets/img/services/doctor-home.jpg"
                     srcset="assets/img/services/doctor-home@2x.jpg 2x"
                     sizes="(max-width: 980px) 50vw, (max-width: 640px) 100vw, 360px"
                     alt="Выезд нарколога на дом — помощь на месте"
                     loading="lazy" decoding="async">
              </picture>
            </figure>

            <div class="service-card__body">
              <h3 class="service-card__title">Выезд нарколога на дом</h3>
              <p class="service-card__desc">
                Для облегчения похмельного синдрома и прерывания запоя. А также при алкогольном отравлении.
              </p>
              <div class="service-card__actions">
                <a href="#cta" class="btn btn--outline">от 3&#8239;500&nbsp;₽</a>
                <a href="#"
                   class="btn btn--primary js-open-callback"
                   aria-controls="callback-modal"
                   aria-label="Выезд нарколога на дом — начать лечение"
                   data-modal-title="Выезд нарколога на дом — начать лечение"
                   data-source="services:doctor-home">Начать лечение</a>
              </div>
            </div>
          </article>
        </div>
      </div>
    </section>

    <section id="steps" class="steps" aria-label="Этапы лечения">
      <div class="container">
        <h2 class="section-title steps__title">Этапы лечения</h2>

        <ol class="steps__list" role="list">
          <li class="steps__item">
            <span class="steps__num" aria-hidden="true">01</span>
            <span class="steps__tick" aria-hidden="true"></span>

            <div class="steps__cap">
              <img
                class="steps__icon"
                src="assets/img/steps/step-01.png"
                width="36" height="36"
                alt=""
                loading="lazy" decoding="async">
              <span class="steps__label">Диагностика состояния</span>
            </div>
          </li>

          <li class="steps__item">
            <span class="steps__num" aria-hidden="true">02</span>
            <span class="steps__tick" aria-hidden="true"></span>

            <div class="steps__cap">
              <img
                class="steps__icon"
                src="assets/img/steps/step-02.png"
                width="36" height="36"
                alt=""
                loading="lazy" decoding="async">
              <span class="steps__label">Составление плана лечения</span>
            </div>
          </li>

          <li class="steps__item">
            <span class="steps__num" aria-hidden="true">03</span>
            <span class="steps__tick" aria-hidden="true"></span>

            <div class="steps__cap">
              <img
                class="steps__icon"
                src="assets/img/steps/step-03.png"
                width="36" height="36"
                alt=""
                loading="lazy" decoding="async">
              <span class="steps__label">Снятие симптомов</span>
            </div>
          </li>

          <li class="steps__item">
            <span class="steps__num" aria-hidden="true">04</span>
            <span class="steps__tick" aria-hidden="true"></span>

            <div class="steps__cap">
              <img
                class="steps__icon"
                src="assets/img/steps/step-04.png"
                width="36" height="36"
                alt=""
                loading="lazy" decoding="async">
                <span class="steps__label">Восстановление организма</span>
            </div>
          </li>

          <li class="steps__item">
            <span class="steps__num" aria-hidden="true">05</span>
            <span class="steps__tick" aria-hidden="true"></span>

            <div class="steps__cap">
              <img
                class="steps__icon"
                src="assets/img/steps/step-05.png"
                width="36" height="36"
                alt=""
                loading="lazy" decoding="async">
              <span class="steps__label">Бесплатные консультации</span>
            </div>
          </li>
        </ol>
      </div>
    </section>

    <section id="about" class="about" aria-label="О клинике">
      <div class="container about__row">
        <div class="about__content">
          <h2 class="section-title about__title">О клинике</h2>
          <p class="about__lead">
            Наши квалифицированные врачи и наркологи предлагают широкий спектр наркологических услуг,
            включая стационарное лечение, кодирование, и многие другие виды лечения. Мы заботимся о
            каждом пациенте и гарантируем высокое качество нашей работы. Не стесняйтесь обращаться к нам
            в любое время, мы всегда готовы оказать наркологическую помощь.
          </p>

          <ul class="about__list" role="list">
            <li class="about__item">
              <span class="about__icon" aria-hidden="true">
                <img class="about__icon-img" src="assets/img/icons/about/doctor.png" width="24" height="24" alt="">
              </span>
              Квалифицированные врачи-наркологи
            </li>
            <li class="about__item">
              <span class="about__icon" aria-hidden="true">
                <img class="about__icon-img" src="assets/img/icons/about/shield.png" width="24" height="24" alt="">
              </span>
              Находим решение даже в сложных ситуациях
            </li>
            <li class="about__item">
              <span class="about__icon" aria-hidden="true">
                <img class="about__icon-img" src="assets/img/icons/about/capsule.png" width="24" height="24" alt="">
              </span>
              Используем импортные проверенные препараты
            </li>
            <li class="about__item">
              <span class="about__icon" aria-hidden="true">
                <img class="about__icon-img" src="assets/img/icons/about/license.png" width="24" height="24" alt="">
              </span>
              Лицензия Л041-01177-91/00561129
            </li>
          </ul>
        </div>

        <div class="about__media">
          <div class="about__slider">
            <div class="about__track">
              <figure class="about__figure about__slide">
                <img src="assets/img/about/clinic-1.png" alt="Фотография клиники и персонала" loading="lazy">
              </figure>

              <figure class="about__figure about__slide">
                <img src="assets/img/about/clinic-1.png" alt="Интерьер клиники" loading="lazy">
              </figure>
            </div>
          </div>

          <div class="about__nav">
            <button class="about__nav-btn about__nav-btn--prev" type="button" aria-label="Предыдущее фото">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                <path d="M15 6l-6 6 6 6" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </button>
            <button class="about__nav-btn about__nav-btn--next" type="button" aria-label="Следующее фото">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                <path d="M9 18l6-6-6-6" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </section>

    <section id="docs" class="docs" aria-label="Документы клиники">
        <div class="container">
            <h2 class="section-title docs__title">
                Имеем все необходимые документы для предоставления медицинских услуг:
            </h2>

            <div class="docs__grid">
                <a class="doc-card" href="assets/img/docs/doc-1.png" target="_blank" rel="noopener">
                    <figure class="doc-card__media">
                        <img src="assets/img/docs/doc-1.png" alt="Выписка из реестра лицензий — документ 1" loading="lazy">
                    </figure>
                </a>

                <a class="doc-card" href="assets/img/docs/doc-2.png" target="_blank" rel="noopener">
                    <figure class="doc-card__media">
                        <img src="assets/img/docs/doc-2.png" alt="Выписка из реестра лицензий — документ 2" loading="lazy">
                    </figure>
                </a>

                <a class="doc-card" href="assets/img/docs/doc-3.png" target="_blank" rel="noopener">
                    <figure class="doc-card__media">
                        <img src="assets/img/docs/doc-3.png" alt="Выписка из реестра лицензий — документ 3" loading="lazy">
                    </figure>
                </a>

                <a class="doc-card" href="assets/img/docs/doc-4.png" target="_blank" rel="noopener">
                    <figure class="doc-card__media">
                        <img src="assets/img/docs/doc-4.png" alt="Выписка из реестра лицензий — документ 4" loading="lazy">
                    </figure>
                </a>
            </div>
        </div>
    </section>

    <section id="staff" class="staff" aria-label="Медицинский персонал">
        <div class="container staff__row">
            <div class="staff__content">
                <h2 class="section-title staff__title">Медицинский<br>персонал</h2>

                <div class="staff__info">
                    <h3 class="staff__name">Меринов Артём Вячеславович</h3>
                    <dl class="staff__meta">
                        <div class="staff__meta-row">
                            <dt>Специализация:</dt>
                            <dd><a href="#services" class="staff__link">Врач-Нарколог</a></dd>
                        </div>
                        <div class="staff__meta-row">
                            <dt>Опыт работы:</dt>
                            <dd><span class="staff__exp">12 лет</span></dd>
                        </div>
                    </dl>
                </div>

                <div class="staff__nav" aria-label="Навигация по сотрудникам">
                    <button class="staff__nav-btn staff__nav-btn--prev" type="button" aria-label="Предыдущий">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M15 6l-6 6 6 6" stroke="#fff" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <button class="staff__nav-btn staff__nav-btn--next" type="button" aria-label="Следующий">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M9 18l6-6-6-6" stroke="#fff" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="staff__gallery" role="list" aria-label="Врачи клиники">
              <article class="staff-card is-active" role="listitem"
                       data-name="Меринов Артём Вячеславович"
                       data-spec="Врач-Нарколог"
                       data-link="#services"
                       data-exp="12 лет">
                <img src="assets/img/staff/doctor-1.png" alt="Меринов Артём Вячеславович — врач-нарколог" loading="lazy">
              </article>

              <article class="staff-card" role="listitem"
                       data-name="Иванова Анна Сергеевна"
                       data-spec="Психотерапевт"
                       data-link="#services"
                       data-exp="9 лет">
                <img src="assets/img/staff/doctor-2.png" alt="Иванова Анна Сергеевна — психотерапевт" loading="lazy">
              </article>

              <article class="staff-card" role="listitem"
                       data-name="Петров Олег Николаевич"
                       data-spec="Терапевт"
                       data-link="#services"
                       data-exp="15 лет">
                <img src="assets/img/staff/doctor-3.png" alt="Петров Олег Николаевич — терапевт" loading="lazy">
              </article>
            </div>
        </div>
    </section>

    <section id="benefits" class="benefits" aria-label="Преимущества вызова нарколога">
        <div class="container benefits__row">
            <figure class="benefits__media">
                <img src="assets/img/benefits/doctor-1.jpg" alt="Врач-нарколог, консультация" loading="lazy">
            </figure>

            <div class="benefits__content">
                <h2 class="section-title benefits__title">Преимущества<br>вызова нарколога</h2>

                <p class="benefits__lead">
                    Обслуживание наркологом на дому имеет ряд плюсов, особенно для тех, кто боится огласки.
                    В этой ситуации обращение в частную наркологию максимально отвечает интересам пациента или его родственников.
                </p>

                <h3 class="benefits__subtitle">Преимущества нашей клиники:</h3>

                <ul class="benefits__list" role="list">
                    <li class="benefits__item">
                        Нарколог на дом прибывает конфиденциально, автомобиль не имеет опознавательных знаков специализированного центра.
                    </li>
                    <li class="benefits__item">
                        Обрыв запойного состояния или снятие абстинентного синдрома проводятся под контролем профессионала,
                        что исключает риски появления осложнений.
                    </li>
                    <li class="benefits__item">
                        Зависимый и его родственники бесплатно получают развёрнутую консультацию по окончании процедуры.
                        Если необходимо, доктор оставляет медикаменты на несколько дней приёма.
                    </li>
                    <li class="benefits__item">
                        Мы не передаём личных данных наших клиентов для постановки на учёт в наркологический диспансер.
                        Обращение к нам для пациентов полностью анонимно.
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section id="cta-motivation" class="cta-motivation" aria-label="Больной не хочет лечиться?">
        <div class="container">
            <div class="cta-motivation__box">
                <div class="cta-motivation__left">
                    <h2 class="cta-motivation__title">БОЛЬНОЙ НЕ ХОЧЕТ<br>ЛЕЧИТЬСЯ?</h2>
                    <p class="cta-motivation__text">
                        Врачами создана эффективная технология мотивации пациентов согласиться на терапию.
                    </p>
                    <p class="cta-motivation__text">
                        Метод показывает высокие результаты — <b>8 из 10</b> людей добровольно решаются начать лечение от зависимости.
                    </p>
                </div>

                <div class="cta-motivation__right">
                    <form id="cta-motivation-form" class="cta-motivation__form" action="api/lead.php" method="post" novalidate>
                        <div class="cta-motivation__row">
                            <label class="sr-only" for="ctaMotivationName">Ваше имя</label>
                            <input class="cta-motivation__input" id="ctaMotivationName" name="name" type="text" placeholder="Ваше имя" autocomplete="name" required>

                            <label class="sr-only" for="ctaMotivationPhone">Телефон</label>
                            <input class="cta-motivation__input" id="ctaMotivationPhone" name="phone" type="tel"
                                   placeholder="+7 999-999-99-99" inputmode="tel" autocomplete="tel" required>
                        </div>

                        <button class="btn btn--primary cta-motivation__btn" type="submit">Получить консультацию</button>

                        <p class="cta-motivation__agree">
                            Нажимая кнопку «Получить консультацию», вы соглашаетесь
                            с <a href="#privacy" class="cta-motivation__link">политикой конфиденциальности</a>
                        </p>

                        <div class="form-msg" aria-live="polite"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section id="faq" class="faq" aria-label="Частые вопросы и ответы">
        <div class="container faq__row">
            <div class="faq__left">
                <h2 class="section-title faq__title">Частые вопросы и ответы</h2>

                <div class="faq__accordion">
                    <details class="faq-item" open>
                        <summary class="faq-item__summary">
                            <span class="faq-item__q">Когда нужно обращаться в наркологическую клинику?</span>
                            <span class="faq-item__toggle" aria-hidden="true"></span>
                        </summary>
                        <div class="faq-item__content">
                            <p>
                                Наши квалифицированные врачи и наркологи предлагают широкий спектр наркологических услуг,
                                включая стационарное лечение, кодирование, и многие другие виды лечения. Мы заботимся о каждом пациенте
                                и гарантируем высокое качество нашей работы. Не стесняйтесь обращаться к нам в любое время, мы всегда готовы
                                оказать наркологическую помощь.
                            </p>
                        </div>
                    </details>

                    <details class="faq-item">
                        <summary class="faq-item__summary">
                            <span class="faq-item__q">Сколько ждать приезда врача?</span>
                            <span class="faq-item__toggle" aria-hidden="true"></span>
                        </summary>
                        <div class="faq-item__content">
                            <p>В среднем выезд занимает 20–40 минут в пределах города, в зависимости от адреса и дорожной обстановки.</p>
                        </div>
                    </details>

                    <details class="faq-item">
                        <summary class="faq-item__summary">
                            <span class="faq-item__q">Какие методики используются для лечения?</span>
                            <span class="faq-item__toggle" aria-hidden="true"></span>
                        </summary>
                        <div class="faq-item__content">
                            <p>Индивидуально подбираемый план: инфузионная терапия, детоксикация, симптоматическая поддержка, кодирование, психотерапевтическая помощь.</p>
                        </div>
                    </details>

                    <details class="faq-item">
                        <summary class="faq-item__summary">
                            <span class="faq-item__q">Как сохранить анонимность при обращении?</span>
                            <span class="faq-item__toggle" aria-hidden="true"></span>
                        </summary>
                        <div class="faq-item__content">
                            <p>Все консультации конфиденциальны, информация защищена и используется только для оказания медицинской помощи.</p>
                        </div>
                    </details>
                </div>
            </div>

            <aside class="faq__right" aria-label="Форма вопроса специалисту">
                <div class="faq__form-card">
                    <h3 class="faq__form-title">Задайте вопрос специалисту</h3>

                    <form id="faq-form" class="faq__form" action="api/faq.php" method="post" novalidate>
                        <label class="sr-only" for="faqPhone">Телефон</label>
                        <input id="faqPhone" name="phone" type="tel" class="faq__input" placeholder="+7 999-999-99-99"
                               inputmode="tel" autocomplete="tel" required>
                            
                        <label class="sr-only" for="faqMessage">Ваш вопрос</label>
                        <textarea id="faqMessage" name="message" class="faq__textarea" placeholder="Ваш вопрос" rows="4" required></textarea>

                        <button class="btn btn--primary faq__btn" type="submit">Отправить</button>

                        <p class="faq__agree">
                            Нажимая кнопку «Отправить», вы соглашаетесь
                            с <a href="#privacy" class="faq__link">политикой конфиденциальности</a>
                        </p>

                        <div class="form-msg" aria-live="polite"></div>
                    </form>
                </div>
            </aside>
        </div>
    </section>

    <section id="reviews" class="reviews" aria-label="Отзывы пациентов">
        <div class="container">
            <div class="reviews__head">
                <h2 class="section-title reviews__title">Отзывы пациентов</h2>

                <div class="reviews__nav" aria-label="Навигация по отзывам">
                    <button class="reviews__nav-btn reviews__nav-btn--prev" type="button" aria-label="Предыдущие отзывы">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M15 6l-6 6 6 6" stroke="#fff" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <button class="reviews__nav-btn reviews__nav-btn--next" type="button" aria-label="Следующие отзывы">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M9 18l6-6-6-6" stroke="#fff" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="reviews__grid">
                <article class="review-card">
                    <span class="review-card__quote" aria-hidden="true">“</span>
                    <h3 class="review-card__author" id="review-title-inna">ИННА</h3>
                    <div class="review-card__text">
                        <p>
                            Моему сыну 28 лет, но он начал злоупотреблять алкоголем, связался с компанией таких же неприятных ребят,
                            бросил работу. Пришлось выводить его из запоя и отправлять на лечение, реабилитацию. Сотрудники центра
                            сделали для нашей семьи очень многое, они вылечили моего ребенка от зависимости и помогли мне пережить
                            этот сложный период.
                        </p>
                    </div>

                    <a id="review-more-inna"
                        class="review-card__more js-review-more"
                        href="#"
                        aria-label="Читать отзыв полностью — Инна"
                        aria-controls="review-modal"
                        data-review-tpl="#tpl-review-inna">
                       Читать полностью
                    </a>

                    <time class="review-card__date" datetime="2023-04-28">28.04.2023</time>

                    <template id="tpl-review-inna">
                        <p>
                            Моему сыну 28 лет, но он начал злоупотреблять алкоголем, связался с компанией таких же неприятных ребят, бросил работу.
                            Пришлось выводить его из запоя и отправлять на лечение, реабилитацию. Сотрудники центра сделали для нашей семьи очень
                            многое, они вылечили моего ребенка от зависимости и помогли мне пережить этот сложный период.
                        </p>
                        <p>
                            Моему сыну 28 лет, но он начал злоупотреблять алкоголем, связался с компанией таких же неприятных ребят, бросил работу.
                        </p>
                    </template>
                </article>

                <article class="review-card">
                    <span class="review-card__quote" aria-hidden="true">“</span>
                    <h3 class="review-card__author" id="review-title-alina">АЛИНА</h3>
                    <div class="review-card__text">
                        <p>
                            Добрый день! В клинику обращались по поводу вывода из запоя, хочу выразить свою благодарность Михаилу и
                            Артуру за профессиональный подход и поддержку, спасибо вам за помощь.
                        </p>
                    </div>

                    <a id="review-more-alina"
                       class="review-card__more js-review-more"
                       href="#"
                       aria-label="Читать отзыв полностью — Алина"
                       aria-controls="review-modal"
                       data-review-tpl="#tpl-review-alina">
                      Читать полностью
                    </a>

                    <time class="review-card__date" datetime="2023-04-28">28.04.2023</time>

                    <template id="tpl-review-alina">
                        <p>
                            Добрый день! В клинику обращались по поводу вывода из запоя, хочу выразить свою благодарность Михаилу и Артуру за
                            профессиональный подход и поддержку, спасибо вам за помощь.
                        </p>
                    </template>
                </article>
            </div>
        </div>
    </section>

    <section id="questions" class="questions" aria-label="Остались вопросы?">
        <div class="container">
            <div class="questions__box">
                <div class="questions__left">
                    <h2 class="questions__title">Остались вопросы?</h2>
                    <p class="questions__subtitle">
                        Просто оставьте заявку и мы вам перезвоним в ближайшее время
                    </p>

                    <form id="questions-form" class="questions__form" action="api/lead.php" method="post" novalidate>
                        <div class="questions__row">
                            <label class="sr-only" for="qName">Ваше имя</label>
                            <input id="qName" name="name" type="text" class="questions__input"
                                   placeholder="Ваше имя" autocomplete="name" required>
                            
                            <label class="sr-only" for="qPhone">Телефон</label>
                            <input id="qPhone" name="phone" type="tel" class="questions__input"
                                   placeholder="+7 999-999-99-99" inputmode="tel" autocomplete="tel" required>
                        </div>

                        <button class="cta__btn js-open-callback" type="button">Получить консультацию</button>

                        <p class="questions__agree">
                            Нажимая кнопку «Получить консультацию», вы
                            соглашаетесь с <a href="#privacy" class="questions__link">политикой конфиденциальности</a>
                        </p>

                        <div class="form-msg" aria-live="polite"></div>
                    </form>
                </div>

                <figure class="questions__media" aria-hidden="true">
                    <img src="assets/img/questions/nurse.png" alt="" loading="lazy">
                </figure>
            </div>
        </div>
    </section>
  </main>

  <footer id="footer" class="footer" aria-label="Футер сайта">
    <div class="container">
        <div class="footer__legal">
            <p>
                Услуги предоставляются ООО «ДЕТОКС» по лицензии Л041-01177-91/00561129 от 02.02.2022 г.
                ОГРН - 1182375001511; ИНН: 2312268085
            </p>
            <p>
                295017, Республика Крым, г. Симферополь, ул. Киевская/пр-кт Победы, д. 75/1 (литера А)

            </p>
            <p>
                350000, Краснодарский край, г. Краснодар, тер Западный внутригородской округ, ул. Северная, д. 324,
                кв. 8, 9, 9/1, 10, 11, 3-й этаж
            </p>
            <p>
                Информация, предоставляемая на данном сайте, не заменяет посещения вашего лечащего доктора.
                Она носит исключительно информационный характер и не является публичной офертой.
            </p>
        </div>
    </div>

    <div class="footer__bar">
        <div class="container">
            <p class="footer__bar-text">
                Имеются противопоказания. Проконсультируйтесь с врачом.
            </p>
        </div>
    </div>
  </footer>

    <div id="review-modal" class="modal" aria-hidden="true">
        <div class="modal__overlay" data-modal-close="overlay"></div>

        <div class="modal__dialog"
            role="dialog"
            tabindex="-1"
            aria-modal="true"
            aria-labelledby="review-modal-title"
            aria-describedby="review-modal-text">

            <button type="button" class="modal__close" aria-label="Закрыть" data-modal-close="button">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M6 6l12 12M18 6L6 18" stroke="#64748B" stroke-width="2.2" stroke-linecap="round"/>
                </svg>
            </button>

            <header class="modal__header">
                <h3 class="modal__title" id="review-modal-title"></h3>
            </header>

            <div class="modal__body" id="review-modal-text">
            </div>

            <hr class="modal__divider" aria-hidden="true">

            <time class="modal__date" id="review-modal-date" datetime="">
            </time>
        </div>
    </div>

    <div id="callback-modal" class="modal" aria-hidden="true">
      <div class="modal__overlay" data-modal-close="overlay"></div>

      <div class="modal__dialog"
          role="dialog"
          tabindex="-1"
          aria-modal="true"
          aria-labelledby="callback-title"
          aria-describedby="callback-desc">
        <button type="button" class="modal__close" aria-label="Закрыть" data-modal-close="button">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M6 6l12 12M18 6L6 18" stroke="#64748B" stroke-width="2.2" stroke-linecap="round"/>
          </svg>
        </button>

        <header class="modal__header">
          <h3 class="modal__title" id="callback-title">Заказать звонок</h3>
          <p class="visually-hidden" id="callback-desc">Оставьте контакты, мы перезвоним</p>
        </header>

        <div id="callback-error" class="form-error" role="alert" aria-live="assertive" hidden></div>

        <form id="callback-form" class="cb-form" autocomplete="on" novalidate>
          <div class="cb-row">
            <div class="field">
              <input id="cb-name" name="name" type="text" class="cb-input"
                    placeholder="Ваше имя" autocomplete="name" required
                    aria-describedby="err-cb-name">
              <div class="field__error" id="err-cb-name" aria-live="assertive"></div>
            </div>

            <div class="field">
              <input id="cb-email" name="email" type="email" class="cb-input"
                    placeholder="you@example.com" autocomplete="email" required
                    aria-describedby="err-cb-email">
              <div class="field__error" id="err-cb-email" aria-live="assertive"></div>
            </div>
          </div>

          <div class="cb-row">
            <div class="field">
              <input id="cb-phone" name="phone" type="tel" class="cb-input"
                    placeholder="+7 999-999-99-99" autocomplete="tel" inputmode="tel" required
                    aria-describedby="err-cb-phone">
               <div class="field__error" id="err-cb-phone" aria-live="assertive"></div>
            </div>
          </div>

          <div class="cb-actions">
            <button id="cb-submit" class="btn btn--primary btn--lg" type="submit">Отправить</button>
          </div>

          <p class="cb-policy">
            Нажимая кнопку «Отправить», вы соглашаетесь с
            <a href="#privacy" target="_blank" rel="noopener">политикой конфиденциальности</a>
          </p>

          <input type="hidden" name="source" value="site-modal">
        </form>

        <div class="form-success" id="callback-success" role="status" aria-live="polite" hidden>
          <p><strong>Заявка отправлена!</strong><br>Мы перезвоним вам в ближайшее время.</p>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
</body>
</html>
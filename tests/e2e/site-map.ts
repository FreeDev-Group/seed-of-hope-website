/**
 * The validated site map (proposal v0.1). Keep in sync with scripts/setup.sh.
 */
export type SitePage = {
  path: string;
  /** Expected text of the single <h1>. */
  h1: string | RegExp;
  /** Expected document <title>. */
  title: RegExp;
};

export const SITE_MAP: SitePage[] = [
  { path: '/', h1: /Semence d’Espoir/, title: /^Seed of Hope/ },
  { path: '/a-propos/', h1: 'À propos', title: /^À propos/ },
  { path: '/nos-programmes/', h1: 'Nos programmes', title: /^Nos programmes/ },
  { path: '/nos-programmes/alphabetisation/', h1: 'Alphabétisation', title: /^Alphabétisation/ },
  { path: '/nos-programmes/formation-professionnelle/', h1: 'Formation professionnelle', title: /^Formation professionnelle/ },
  { path: '/actualites/', h1: 'Actualités et activités', title: /^Actualités et activités/ },
  { path: '/temoignages/', h1: 'Témoignages et réalisations', title: /^Témoignages et réalisations/ },
  { path: '/partenaires/', h1: 'Partenaires', title: /^Partenaires/ },
  { path: '/soutenir/', h1: 'Soutenir le ministère', title: /^Soutenir le ministère/ },
  { path: '/contact/', h1: 'Contact', title: /^Contact/ },
];

/** Other templates worth covering: single post, search results and 404. */
export const OTHER_TEMPLATES = [
  { path: '/exemple-actualite-1/', name: 'single post', status: 200 },
  { path: '/?s=programme', name: 'search results', status: 200 },
  { path: '/cette-page-n-existe-pas/', name: '404', status: 404 },
];

/** Top-level labels of the main menu, in order. */
export const MENU_LABELS = [
  'Accueil',
  'À propos',
  'Programmes',
  'Actualités',
  'Témoignages',
  'Partenaires',
  'Nous soutenir',
  'Contact',
];

/** PHP errors as printed by WordPress with WP_DEBUG on, and the fatal error screen. */
export const PHP_ERROR = /<b>(Fatal error|Parse error|Warning|Notice|Deprecated)<\/b>:|erreur critique|critical error/i;

# Project brief — Seed of Hope / Semence d'Espoir website

Source: *Proposition de projet et cahier des charges préliminaire*, v0.1 (FreeDev, October 2026).
This brief is a working summary for the team. **The proposal is not validated yet**: every item marked
"to confirm" stays a placeholder `[À confirmer par Seed of Hope]` on the site until the client answers.

| | |
| --- | --- |
| Client | Seed of Hope (Semence d'Espoir), a ministry of LePhare — Bukavu, DR Congo |
| Type | Institutional and educational website, in French (English to confirm) |
| Project lead | Samuel BITINGINGWA (@Samuel11s) — Kampala |
| Developers | Jonathan (@Bitingingwa) — Kampala · Josué (@kamojosue09-blip) — Bukavu |
| Schedule | 5 weeks · **M2 build: 5 Nov 2026** · **M3 delivery: 4 Dec 2026** |

## Site map (proposal v0.1)

| Page | Purpose | URL on the demo site |
| --- | --- | --- |
| Accueil | Short presentation, mission, programmes, recent activities, contact | `/` |
| À propos | Identity, history, mission, vision, values, link with LePhare | `/a-propos/` |
| Nos programmes | Overview of the programmes | `/nos-programmes/` |
| Alphabétisation | Objectives, audience, how to take part (validated info only) | `/nos-programmes/alphabetisation/` |
| Formation professionnelle | Tracks or workshops actually offered, access conditions | `/nos-programmes/formation-professionnelle/` |
| Actualités et activités | Announcements, events, workshops, news | `/actualites/` (WordPress posts page) |
| Témoignages / réalisations | Testimonials and impact, **only with consent** | `/temoignages/` |
| Partenaires | Confirmed partners, collaboration opportunities | `/partenaires/` |
| Soutenir le ministère | Volunteering, donations, partnerships, **if these options exist** | `/soutenir/` |
| Contact | Official contact details, location | `/contact/` |

## Audiences

- Adults who want to learn to read and write or strengthen basic skills — **some read with difficulty**:
  short sentences, explicit links and buttons, large readable text, no information conveyed only by images.
- Adults interested in vocational or practical training.
- Former and current participants.
- Families and community members.
- Trainers, volunteers, people who want to contribute.
- Institutional partners, associations, potential supporters.
- LePhare and Seed of Hope leaders who publish the activities.

Tone: clear, respectful, hopeful. **Never present learners as incapable** or reduce them to their difficulties.
Respect their dignity, privacy and consent in texts and images.

## Features

### Core (in scope)
- Institutional pages and programme pages, editable in the Site Editor by non-developers.
- News and announcements (WordPress posts).
- Clear, mobile-friendly navigation; keyboard accessible; WCAG 2.2 AA checks in CI.
- Links to official channels (once confirmed).
- Contact page with validated details. **Contact form: subject to validation** (data collected, who answers).
- Admin access for authorised people (Editor role for the client).
- Translation-ready (French now, English later if confirmed).

### To decide separately (not in the initial scope)
- Information request or pre-registration form.
- Training / activity calendar.
- Photo or video gallery.
- Newsletter sign-up.
- Online donations.
- Private learner area, registration management, learning follow-up, certificates
  (requires a specific data-protection analysis).
- Impact figures section (pattern ready but **disabled** until real figures are confirmed).
- "Programme" content type (see `docs/decisions.md`, ADR-006).

## Information to obtain from the client

Each line is tracked as a GitHub issue labelled `type:content` + `blocked:client`.

| # | Information | Used on |
| --- | --- | --- |
| 1 | **Official name** to display: Seed of Hope, Semence d'Espoir, or both (and in which order) | Header, footer, titles, SEO |
| 2 | **Official wording of the link with LePhare** | Hero, À propos, footer |
| 3 | Mission, vision, values and approved history | Accueil, À propos |
| 4 | **Programmes actually offered**: names, description, audience, prerequisites, duration, schedule, location, conditions, fees (if any), contact person | Nos programmes, Alphabétisation, Formation professionnelle |
| 5 | **Logo, official colours**, approved photos (with consent) — and whether LePhare's visual identity applies | Whole site |
| 6 | **Contact details**: address, phone, email, social media, opening hours, person who answers | Contact, footer |
| 7 | **Languages**: French only, or French + English at launch | Whole site, plugin choice |
| 8 | **Domain name**: existing domain? who owns it? or which one to register | Hosting, email |
| 9 | **Validators**: who provides content, who approves pages, who will be WordPress administrator/editor | Workflow, handover |
| 10 | Confirmed partners and permission to show their logos | Partenaires |
| 11 | Testimonials and photos with written consent | Témoignages |
| 12 | Support options that really exist (volunteering, donations, partnerships) | Soutenir le ministère |
| 13 | Launch features vs later (form, calendar, gallery, newsletter, donations) | Scope |
| 14 | Who pays the hosting from year 2 and with which card | Hosting handover |

## Out of scope / guarantees

- No invented address, phone number, programme, figure, testimonial or partner.
- No promise of diploma, job or result without an official basis.
- No paid plugin; any third-party plugin is listed and justified in `docs/decisions.md` first.
- No collection of learner data without a specific analysis and approval.

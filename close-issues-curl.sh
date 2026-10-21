#!/usr/bin/env bash
LOG="close-issues.log"
REPO_OWNER="aureopires"
REPO_NAME="projet_broderie"
REPO="$REPO_OWNER/$REPO_NAME"
API_BASE="https://api.github.com/repos/$REPO"

# Obtain token: prefer GITHUB_TOKEN env, else try gh auth token
GITHUB_TOKEN="${GITHUB_TOKEN:-}"
if [ -z "$GITHUB_TOKEN" ]; then
  if command -v gh >/dev/null 2>&1; then
    GITHUB_TOKEN="$(gh auth token 2>/dev/null || true)"
  fi
fi

if [ -z "$GITHUB_TOKEN" ]; then
  echo "Erro: não encontrei GITHUB_TOKEN nem 'gh auth token'. Exporte GITHUB_TOKEN ou rode 'gh auth login'." >&2
  exit 1
fi
export GITHUB_TOKEN

# require python3 to safely build JSON bodies
if ! command -v python3 >/dev/null 2>&1; then
  echo "Erro: python3 é necessário para este script." >&2
  exit 1
fi

# Mapping issue -> comment and milestone TITLE
declare -A MSG
declare -A MILESTONE_TITLE

MSG[11]=$'Implementado em 2026-08-30 — evidência: https://github.com/aureopires/projet_broderie/commit/c288c238a9207e2b2041e6cbad2b710f2203d88f\nTambém: https://github.com/aureopires/projet_broderie/commit/cee24b6d1b34451a55d44e0238ad6fb3e4ef823f'
MILESTONE_TITLE[11]="3 - Modélisation et Base de Données Relationnelle (Doctrine & MariaDB)"

MSG[12]=$'Implementado em 2026-08-03 — evidência: https://github.com/aureopires/projet_broderie/commit/cee24b6d1b34451a55d44e0238ad6fb3e4ef823f'
MILESTONE_TITLE[12]="4 - Sécurité et Composants Métier (Symfony Security)"

MSG[13]=$'Implementado em 2026-08-03 — evidência: https://github.com/aureopires/projet_broderie/commit/cee24b6d1b34451a55d44e0238ad6fb3e4ef823f'
MILESTONE_TITLE[13]="4 - Sécurité et Composants Métier (Symfony Security)"

MSG[14]=$'Implementado entre 2026-08-03 e 2026-08-30 — evidência: https://github.com/aureopires/projet_broderie/commit/cee24b6d1b34451a55d44e0238ad6fb3e4ef823f and https://github.com/aureopires/projet_broderie/commit/c288c238a9207e2b2041e6cbad2b710f2203d88f'
MILESTONE_TITLE[14]="4 - Sécurité et Composants Métier (Symfony Security)"

MSG[15]=$'Implementado (layout base Twig + integração Bootstrap) — evidência principal: https://github.com/aureopires/projet_broderie/commit/cee24b6d1b34451a55d44e0238ad6fb3e4ef823f'
MILESTONE_TITLE[15]="5 - Interfaces Utilisateur, Design et Internationalisation"

MSG[17]=$'Implementado: controllers com addFlash em 2026-08-03 e JS adicional em 2026-10-01 — evidência: https://github.com/aureopires/projet_broderie/commit/cee24b6d1b34451a55d44e0238ad6fb3e4ef823f e https://github.com/aureopires/projet_broderie/commit/a4f77e6'
MILESTONE_TITLE[17]="5 - Interfaces Utilisateur, Design et Internationalisation"

MSG[18]=$'Implementado (Front-Office: catálogo, filtros, formulário de devis, espaço de avis) — evidência: https://github.com/aureopires/projet_broderie/commit/cee24b6d1b34451a55d44e0238ad6fb3e4ef823f e https://github.com/aureopires/projet_broderie/commit/c288c238a9207e2b2041e6cbad2b710f2203d88f'
MILESTONE_TITLE[18]="6 - Back-Office Administrateur et Front-Office (Architecture en Couches)"

MSG[19]=$'Implementado em 2026-08-03 — evidência: https://github.com/aureopires/projet_broderie/commit/cee24b6d1b34451a55d44e0238ad6fb3e4ef823f'
MILESTONE_TITLE[19]="6 - Back-Office Administrateur et Front-Office (Architecture en Couches)"

ISSUES=(11 12 13 14 15 17 18 19)

echo
echo "Vou adicionar um comentário de evidência e fechar as issues: ${ISSUES[*]}"
echo "Repo: $REPO"
echo "Observação: o campo closed_at será a data/hora atual. As datas de implementação são incluídas nos comentários."
echo
read -p "Confirmar execução? (s/N) " CONF
if [[ ! "$CONF" =~ ^[sS]$ ]]; then
  echo "Cancelado pelo usuário."
  exit 0
fi

echo "Início: $(date)" > "$LOG"

# fetch milestones list once
MIL_JSON="$(curl -s -H "Authorization: token $GITHUB_TOKEN" "$API_BASE/milestones?per_page=200")"

for n in "${ISSUES[@]}"; do
  title="${MILESTONE_TITLE[$n]}"
  echo "----" | tee -a "$LOG"
  echo "$(date) - Processando #$n (milestone title: \"$title\")" | tee -a "$LOG"

  # resolve milestone number (try jq if available)
  if command -v jq >/dev/null 2>&1; then
    MNUM="$(printf '%s' "$MIL_JSON" | jq -r --arg T "$title" '.[] | select(.title == $T) | .number' | head -n1)"
  else
    MNUM="$(printf '%s\n' "$MIL_JSON" | grep -B3 "\"title\": \"$title\"" | grep '"number"' | head -n1 | sed -E 's/[^0-9]*([0-9]+).*/\1/' || true)"
  fi

  if [ -z "$MNUM" ] || [ "$MNUM" = "null" ]; then
    echo "$(date) - Milestone não encontrado para título: \"$title\". O payload seguirá sem milestone." | tee -a "$LOG"
    MNUM=""
  else
    echo "$(date) - Milestone resolvido: $MNUM" | tee -a "$LOG"
  fi

  # 1) create comment
  body="${MSG[$n]}"
  comment_json="$(python3 - <<PY
import sys, json
b = sys.stdin.read()
print(json.dumps({"body": b}))
PY
<<<"$body")"
  code=$(curl -s -o /dev/null -w "%{http_code}" -X POST \
    -H "Authorization: token $GITHUB_TOKEN" \
    -H "Accept: application/vnd.github+json" \
    "$API_BASE/issues/$n/comments" \
    -d "$comment_json")
  echo "$(date) - comment HTTP $code" | tee -a "$LOG"

  # 2) patch issue: close + milestone (if found)
  if [ -n "$MNUM" ]; then
    payload="{\"state\":\"closed\",\"milestone\": $MNUM}"
  else
    payload="{\"state\":\"closed\"}"
  fi

  code2=$(curl -s -o /dev/null -w "%{http_code}" -X PATCH \
    -H "Authorization: token $GITHUB_TOKEN" \
    -H "Accept: application/vnd.github+json" \
    -H "Content-Type: application/json" \
    "$API_BASE/issues/$n" \
    -d "$payload")
  echo "$(date) - edit HTTP $code2 (payload: $payload)" | tee -a "$LOG"

  # small pause to be polite with API
  sleep 1
done

echo "Fim: $(date)" | tee -a "$LOG"
echo "Log salvo em: $LOG"

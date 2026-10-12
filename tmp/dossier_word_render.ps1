param([string]$InputDocx, [string]$OutputPdf, [switch]$Refresh)
$ErrorActionPreference = 'Stop'
$word = $null
$document = $null
try {
  $word = New-Object -ComObject Word.Application
  $word.Visible = $false
  $word.DisplayAlerts = 0
  $document = $word.Documents.Open($InputDocx, $false, (-not $Refresh))
  if ($Refresh) {
    $document.Fields.Update() | Out-Null
    $document.Repaginate()
    $document.Fields.Update() | Out-Null
    $document.Save()
  }
  $document.ExportAsFixedFormat($OutputPdf, 17)
  Write-Output ('PDF exported: ' + $OutputPdf)
} finally {
  if ($document) { try { $document.Close(0) } catch { Write-Warning 'Word document cleanup unavailable.' } }
  if ($word) { try { $word.Quit() } catch { Write-Warning 'Word application cleanup unavailable.' } }
}

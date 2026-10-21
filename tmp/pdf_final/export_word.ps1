$ErrorActionPreference = 'Stop'
$base = '\\wsl.localhost\Ubuntu\home\aureopires\dev\projet_broderie'
$source = 'C:/Users/aureo/.codex/visualizations/2026/10/17/01a14943-50d9-7021-9982-2b47cc8e2d34/pdf_final/input.docx'
$pdfPath = 'C:/Users/aureo/.codex/visualizations/2026/10/17/01a14943-50d9-7021-9982-2b47cc8e2d34/pdf_final/final.pdf'
$word = New-Object -ComObject Word.Application
$doc = $null
try {
 $word.Visible = $false
 $word.DisplayAlerts = 0
 $word.AutomationSecurity = 3
 Write-Output "OPENING"; $doc = $word.Documents.Open($source, $false, $true, $false); Write-Output "OPENED"
 $doc.Repaginate()
 foreach ($toc in $doc.TablesOfContents) { $toc.Update() }
 $doc.Repaginate()
 foreach ($toc in $doc.TablesOfContents) { $toc.UpdatePageNumbers() }
 $doc.Repaginate()
 Write-Output "EXPORTING"; $doc.ExportAsFixedFormat($pdfPath, 17, $false, 0, 0, 1, 1, 0, $true, $true, 1, $true, $true, $false)
 Write-Output "EXPORTED"; $headings = @()
 foreach ($p in $doc.Paragraphs) {
  if ($p.OutlineLevel -le 2) {
   $headings += [pscustomobject]@{text=$p.Range.Text.Trim(); page=$p.Range.Information(1); physicalPage=$p.Range.Information(3)}
  }
 }
 $headings | ConvertTo-Json -Depth 3 | Set-Content (Join-Path $base 'tmp\pdf_final\headings.json') -Encoding UTF8
 $tocText = @()
 foreach ($toc in $doc.TablesOfContents) { $tocText += $toc.Range.Text }
 $tocText | Set-Content (Join-Path $base 'tmp\pdf_final\toc.txt') -Encoding UTF8
 Write-Output "PAGES=$($doc.ComputeStatistics(2)) IMAGES=$($doc.InlineShapes.Count) TOCS=$($doc.TablesOfContents.Count)"
 Write-Output $pdfPath
} finally {
 if ($doc) { $doc.Close(0) }
 $word.Quit()
}



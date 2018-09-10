import os

def getSize(startPath ="../../assets/img/posted/"):
    totalSize = 0
    for dirpath, dirnames, filenames in os.walk(startPath):
        for f in filenames:
            fp = os.path.join(dirpath, f)
            totalSize += os.path.getsize(fp)
    return totalSize


def saveSizeToFile(sizeInBytes):
    sizeInMegaBytes = sizeInBytes / 1048576
    sizeInMegaBytes = "%.2f" % sizeInMegaBytes
    fileObject = open("../../assets/dirSize", 'w')
    fileObject.write(str(sizeInMegaBytes))
    fileObject.close()
    return 0


saveSizeToFile(getSize())